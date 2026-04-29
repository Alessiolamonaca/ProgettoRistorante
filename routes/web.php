<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::redirect('/', '/'.config('locales.default', 'it'));

Route::group([
    'prefix' => '{locale}',
    'middleware' => 'setLocale',
    'where' => [
        'locale' => implode('|', config('locales.supported', ['it'])),
    ],
], function () {
    Route::controller(PageController::class)->group(function () {
        Route::get('/', 'home')->name('home');
        Route::get('/ristorante', 'restaurant')->name('ristorante');
        Route::get('/menu', 'menu')->name('menu');
        Route::get('/dove-siamo', 'where')->name('dove-siamo');
        Route::get('/contatti', 'contacts')->name('contatti');
        Route::get('/privacy', 'privacy')->name('privacy');
    });

    Route::post('/contatti', ContactController::class)
        ->middleware('throttle:contact-form')
        ->name('contatti.submit');

    Route::fallback([PageController::class, 'notFound'])->name('not-found');
});
