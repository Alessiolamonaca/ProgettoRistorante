<?php

use App\Mail\ContactRequestMail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Sitemap XML
|--------------------------------------------------------------------------
|
| Sitemap multilingua per tutte le pagine principali del sito.
| URL: /sitemap.xml
|
*/

Route::get('/sitemap.xml', function () {
    $locales = config('locales.supported', ['it']);

    $pages = [
        '',            // home
        'ristorante',
        'menu',
        'dove-siamo',
        'contatti',
        'privacy',
    ];

    $baseUrl = request()->root(); // es: http://127.0.0.1:8000

    $urls = [];

    foreach ($locales as $locale) {
        foreach ($pages as $slug) {
            $path = '/' . $locale;

            if ($slug !== '') {
                $path .= '/' . $slug;
            }

            $urls[] = [
                'loc'        => $baseUrl . $path,
                'changefreq' => $slug === 'menu' ? 'weekly' : 'monthly',
                'priority'   => $slug === '' ? '1.0' : '0.8',
            ];
        }
    }

    return response()
        ->view('sitemap', ['urls' => $urls])
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

/*
|--------------------------------------------------------------------------
| Rotta root
|--------------------------------------------------------------------------
|
| Quando l'utente va su "/", lo reindirizziamo alla lingua di default.
| La lingua di default è definita in config/locales.php (chiave "default").
|
*/

Route::get('/', function () {
    $defaultLocale = config('locales.default', 'it');

    return redirect()->to('/' . $defaultLocale);
});

/*
|--------------------------------------------------------------------------
| Gruppo di rotte multilingua
|--------------------------------------------------------------------------
|
| Tutte le rotte pubbliche sono prefissate con {locale} (it, en, de, es, fr).
| Il middleware "setLocale" imposta la lingua dell'app a partire dal parametro.
|
*/

Route::group([
    'prefix'     => '{locale}',
    'middleware' => 'setLocale',
    'where'      => [
        // accetta solo i codici lingua effettivamente configurati
        'locale' => implode('|', config('locales.supported', ['it'])),
    ],
], function () {
    // Home: /it, /en, /de, ...
    Route::get('/', function (string $locale) {
        return view('pages.home');
    })->name('home');

    // Il Ristorante
    Route::get('/ristorante', function (string $locale) {
        return view('pages.ristorante');
    })->name('ristorante');

    // Menu
    Route::get('/menu', function (string $locale) {
        $categories = Category::with([
                'dishes' => function ($query) {
                    $query->where('is_active', true)
                          ->orderBy('position');
                },
            ])
            ->orderBy('position')
            ->get();

        return view('pages.menu', compact('categories'));
    })->name('menu');

    // Dove siamo
    Route::get('/dove-siamo', function (string $locale) {
        return view('pages.dove-siamo');
    })->name('dove-siamo');

    // Contatti (GET)
    Route::get('/contatti', function (string $locale) {
        return view('pages.contatti');
    })->name('contatti');

    // Privacy & Cookie
    Route::get('/privacy', function (string $locale) {
        return view('pages.privacy');
    })->name('privacy');

    // Contatti (POST) – invio form
    Route::post('/contatti', function (Request $request, string $locale) {
        // assicuriamoci che la lingua dei messaggi di validazione sia corretta
        app()->setLocale($locale);

        $validated = $request->validate(
            [
                'name'    => ['required', 'string', 'max:255'],
                'email'   => ['required', 'email', 'max:255'],
                'message' => ['required', 'string', 'max:2000'],
            ],
            [
                'name.required'    => __('validation_contact.name_required'),
                'name.max'         => __('validation_contact.name_max', ['max' => 255]),
                'email.required'   => __('validation_contact.email_required'),
                'email.email'      => __('validation_contact.email_email'),
                'email.max'        => __('validation_contact.email_max', ['max' => 255]),
                'message.required' => __('validation_contact.message_required'),
                'message.max'      => __('validation_contact.message_max', ['max' => 2000]),
            ]
        );

        // Log per debug
        Log::info('Contact form request', [
            'locale' => $locale,
            'name'   => $validated['name'],
            'email'  => $validated['email'],
        ]);

        // Invio email al ristorante (se configurato)
        $to = config('restaurant.email');

        if ($to) {
            try {
                Mail::to($to)->send(new ContactRequestMail($validated));
            } catch (\Throwable $e) {
                Log::error('Errore invio email contatti', [
                    'error' => $e->getMessage(),
                ]);
                // Non blocchiamo l’utente se c’è un problema di email
            }
        }

        return back()->with('success', __('pages.contacts.success'));
    })->name('contatti.submit');

    /*
    |--------------------------------------------------------------------------
    | Fallback 404 per la lingua corrente
    |--------------------------------------------------------------------------
    |
    | Qualsiasi URL /{locale}/... che non corrisponde alle rotte sopra
    | finisce qui. Ritorniamo la view "pages.not-found" con status 404.
    |
    */
    Route::fallback(function (string $locale) {
        // Il middleware setLocale ha già impostato la lingua corretta
        return response()
            ->view('pages.not-found', [], 404);
    })->name('not-found');
});
