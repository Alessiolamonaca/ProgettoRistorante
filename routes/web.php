<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    'where'      => ['locale' => '[a-z]{2}'],
], function () {

    // Home: /it, /en, /de, ...
    Route::get('/', function () {
        return view('pages.home');
    })->name('home');

    // Il Ristorante
    Route::get('/ristorante', function () {
        return view('pages.ristorante');
    })->name('ristorante');

    // Menu
    Route::get('/menu', function () {
        return view('pages.menu');
    })->name('menu');

    // Dove siamo
    Route::get('/dove-siamo', function () {
        return view('pages.dove-siamo');
    })->name('dove-siamo');

    // Contatti (GET)
    Route::get('/contatti', function () {
        return view('pages.contatti');
    })->name('contatti');

    // Contatti (POST) – invio form
    Route::post('/contatti', function (Request $request, string $locale) {
        // Il middleware ha già impostato la locale, qui la forziamo comunque
        app()->setLocale($locale);

        // Validazione con messaggi personalizzati per ogni lingua
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ], [
            'name.required'    => __('validation_contact.name_required'),
            'name.max'         => __('validation_contact.name_max', ['max' => 255]),
            'email.required'   => __('validation_contact.email_required'),
            'email.email'      => __('validation_contact.email_email'),
            'email.max'        => __('validation_contact.email_max', ['max' => 255]),
            'message.required' => __('validation_contact.message_required'),
            'message.max'      => __('validation_contact.message_max', ['max' => 2000]),
        ]);

        // Per ora salviamo solo nei log (nessun invio email)
        Log::info('Contact form request', [
            'locale' => $locale,
            'name'   => $validated['name'],
            'email'  => $validated['email'],
        ]);

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
        // Il middleware SetLocale ha già impostato la lingua corretta
        return response()
            ->view('pages.not-found', [], 404);
    })->name('not-found');
});
