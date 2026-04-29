<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function restaurant(): View
    {
        return view('pages.ristorante');
    }

    public function menu(): View
    {
        $categories = Category::query()
            ->with([
                'dishes' => fn ($query) => $query
                    ->where('is_active', true)
                    ->orderBy('position'),
            ])
            ->orderBy('position')
            ->get();

        return view('pages.menu', compact('categories'));
    }

    public function where(): View
    {
        return view('pages.dove-siamo');
    }

    public function contacts(): View
    {
        return view('pages.contatti');
    }

    public function privacy(): View
    {
        return view('pages.privacy');
    }

    public function notFound(): Response
    {
        return response()
            ->view('pages.not-found', [], 404);
    }
}
