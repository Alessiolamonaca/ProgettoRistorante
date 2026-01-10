<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

// Quando l'utente va su /, lo mandiamo alla lingua di default (it)
Route::get('/', function () {
    $defaultLocale = config('locales.default', 'it');

    return redirect()->to('/' . $defaultLocale);
});

// Gruppo di rotte con prefisso lingua: /it, /en, /de, /es, /fr
Route::group([
    'prefix'     => '{locale}',
    'middleware' => 'setLocale',
    // accettiamo solo due lettere (it, en, de, es, fr – il filtro reale lo fa SetLocale)
    'where'      => ['locale' => '[a-z]{2}'],
], function () {
    
    Route::post('/contatti', function (Request $request, string $locale) {
        // la locale è già impostata dal middleware, ma la assicuriamo
        app()->setLocale($locale);

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
    Log::info(...);

        // Per ora non inviamo email: registriamo solo nei log
    Log::info('Contact form request', [
            'locale' => $locale,
            'name'   => $validated['name'],
            'email'  => $validated['email'],
        ]);

        return back()->with('success', __('pages.contacts.success'));
    })->name('contatti.submit');


    Route::get('/', function () {
        return view('pages.home');
    })->name('home');

    Route::get('/ristorante', function () {
        return view('pages.ristorante');
    })->name('ristorante');

    Route::get('/menu', function () {
        return view('pages.menu');
    })->name('menu');

    Route::get('/dove-siamo', function () {
        return view('pages.dove-siamo');
    })->name('dove-siamo');

    Route::get('/contatti', function () {
        return view('pages.contatti');
    })->name('contatti');
});
