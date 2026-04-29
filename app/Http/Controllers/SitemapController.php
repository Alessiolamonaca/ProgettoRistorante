<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $locales = config('locales.supported', ['it']);
        $pages = [
            '',
            'ristorante',
            'menu',
            'dove-siamo',
            'contatti',
            'privacy',
        ];

        $baseUrl = request()->root();
        $urls = [];

        foreach ($locales as $locale) {
            foreach ($pages as $slug) {
                $path = '/'.$locale;

                if ($slug !== '') {
                    $path .= '/'.$slug;
                }

                $urls[] = [
                    'loc' => $baseUrl.$path,
                    'changefreq' => $slug === 'menu' ? 'weekly' : 'monthly',
                    'priority' => $slug === '' ? '1.0' : '0.8',
                ];
            }
        }

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
