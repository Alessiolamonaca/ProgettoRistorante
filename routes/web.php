<?php

use Illuminate\Support\Facades\Route;

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
