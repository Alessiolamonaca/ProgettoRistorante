<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php
        // Titolo e meta base
        $pageTitle = $title ?? config('restaurant.name', 'Ristorante');
        $currentUrl = request()->fullUrl();
        $metaDesc   = $metaDescription ?? null;

        // Open Graph
        $ogImage  = config('restaurant.og_image');
        $siteName = config('restaurant.site_name', config('restaurant.name', 'Ristorante'));
        $ogLocale = str_replace('-', '_', app()->getLocale()) . '_' . strtoupper(app()->getLocale()); // es: it_IT

        // Dati per hreflang
        $path      = request()->path(); // es: "it/menu"
        // rimuove il prefisso lingua (it/..., en/..., ecc.)
        $rest      = preg_replace('#^[a-z]{2}(/|$)#', '', $path);
        $rest      = ltrim((string) $rest, '/'); // es: "menu" oppure stringa vuota
        $rootUrl   = request()->root();          // es: http://127.0.0.1:8000
        $locales   = config('locales.supported', ['it']);
        $default   = config('locales.default', 'it');
    @endphp

    <title>{{ $pageTitle }}</title>

    @if($metaDesc)
        <meta name="description" content="{{ $metaDesc }}">
    @endif

    <meta name="robots" content="index,follow">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ $currentUrl }}">

    {{-- hreflang per ogni lingua supportata --}}
    @foreach ($locales as $lang)
        @php
            $href = $rootUrl . '/' . $lang . ($rest ? '/' . $rest : '');
        @endphp
        <link rel="alternate" hreflang="{{ $lang }}" href="{{ $href }}">
    @endforeach

    {{-- hreflang x-default (versione di default) --}}
    <link rel="alternate"
        hreflang="x-default"
        href="{{ $rootUrl . '/' . $default . ($rest ? '/' . $rest : '') }}">

    {{-- Open Graph base --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $pageTitle }}">
    @if($metaDesc)
        <meta property="og:description" content="{{ $metaDesc }}">
    @endif
    <meta property="og:url" content="{{ $currentUrl }}">
    @if($ogImage)
        <meta property="og:image" content="{{ $ogImage }}">
    @endif
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:locale" content="{{ $ogLocale }}">

    <style>
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; margin: 0; background: #0b0b0b; color: #f3f3f3; }

        .container { max-width: 1100px; margin: 0 auto; padding: 16px; }
                .page {
            padding-top: 32px;
            padding-bottom: 32px;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-header h1 {
            margin: 0 0 8px;
            font-size: 32px;
            line-height: 1.2;
        }

        .page-header .muted {
            max-width: 640px;
        }

        header { position: sticky; top: 0; background: rgba(10,10,10,.9); backdrop-filter: blur(8px); border-bottom: 1px solid rgba(255,255,255,.08); z-index: 50; }

        nav { display:flex; gap:12px; align-items:center; justify-content:space-between; flex-wrap:wrap; }

        .nav-left, .nav-right { display:flex; gap:12px; align-items:center; flex-wrap: wrap; }

        a { color: inherit; text-decoration: none; opacity: .9; }

        a:hover { opacity: 1; }

        .pill { padding: 8px 12px; border: 1px solid rgba(255,255,255,.12); border-radius: 999px; }

        .primary { background: #f5f5f5; color:#111; border-color: transparent; }

        .lang a { font-size: 12px; padding: 6px 10px; border: 1px solid rgba(255,255,255,.12); border-radius: 999px; }

        .lang a.active { background: #f5f5f5; color:#111; border-color: transparent; }

.hero {
    padding: 56px 0;
    border-bottom: 1px solid rgba(255,255,255,.08);
    background: radial-gradient(800px 300px at 20% 10%, rgba(255,255,255,.08), transparent);
}

.grid {
    display: grid;
    gap: 16px;
    grid-template-columns: 1fr;
}

@media (min-width: 800px) {
    .grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .hero .grid {
        grid-template-columns: 1.2fr 0.8fr;
        align-items: center;
    }
}

        
        @media (min-width: 800px) { .grid { grid-template-columns: 1.2fr .8fr; } }
        .card {
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 16px;
            padding: 16px;
            background: rgba(255,255,255,.03);
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease, background .2s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(0,0,0,.55);
            border-color: rgba(255,255,255,.16);
            background: rgba(255,255,255,.04);
        }

        footer { border-top: 1px solid rgba(255,255,255,.08); margin-top: 40px; padding: 20px 0; opacity: .85; }
        .muted { opacity: .8; }

        /* Link principali di navigazione (Ristorante, Menu, Dove siamo, Contatti) */
        a {
            color: inherit;
            text-decoration: none;
            opacity: .9;
            transition: opacity .2s ease;
        }

        a:hover {
            opacity: 1;
        }

        .pill {
            padding: 8px 12px;
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 999px;
            transition: background .2s ease, color .2s ease, transform .15s ease, box-shadow .15s ease;
        }

        .pill:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(0,0,0,.45);
        }

        .primary {
            background: #f5f5f5;
            color:#111;
            border-color: transparent;
        }

        .nav-main-link {
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid transparent;
            font-size: 14px;
            transition: background .2s ease, border-color .2s ease, color .2s ease;
        }

        .nav-main-link.active {
            border-color: rgba(255,255,255,.45);
            background: rgba(255,255,255,.10);
        }

        /* Piccoli aggiustamenti per mobile */
        @media (max-width: 640px) {
            body {
                font-size: 15px;
            }

            header {
                position: static;
            }

            .nav-left,
            .nav-right {
                width: 100%;
                justify-content: space-between;
                gap: 8px;
            }

            .pill {
                padding: 7px 10px;
            }

            .primary {
                font-weight: 600;
            }
        }


        .hero-image {
            border-radius: 20px;
            overflow: hidden;
            min-height: 260px;
            background-size: cover;
            background-position: center;
            transition: transform .3s ease, box-shadow .3s ease;
        }

        .hero-image:hover {
            transform: scale(1.01);
            box-shadow: 0 18px 36px rgba(0,0,0,.7);
        }


        .gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-top: 12px;
        }

        .gallery img {
            width: 100%;
            height: 90px;
            object-fit: cover;
            border-radius: 12px;
            display: block;
            transition: transform .2s ease, box-shadow .2s ease, opacity .2s ease;
        }

        .gallery img:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 18px rgba(0,0,0,.6);
            opacity: .95;
        }



        @media (max-width: 640px) {
            .gallery {
                grid-template-columns: repeat(2, 1fr);
            }
        }

            /* --- Hero home page --- */

    .hero-heading {
        margin: 0 0 12px;
        font-size: 40px;
        line-height: 1.1;
    }

    .hero-lead {
        margin: 0 0 18px;
        max-width: 560px;
    }

    .hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    @media (max-width: 768px) {
        .hero-heading {
            font-size: 30px;
        }

        .hero-lead {
            font-size: 15px;
        }
    }

        /* --- Pagina Menu --- */

    .menu-category-title {
        margin: 0 0 6px;
        font-size: 20px;
    }

    .menu-dishes {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 6px;
    }

    .menu-dish-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
    }

    .menu-dish-text {
        flex: 1 1 auto;
        min-width: 0;
    }

    .menu-dish-name {
        margin: 0;
        font-weight: 600;
    }

    .menu-dish-description {
        margin: 2px 0 0;
        font-size: 14px;
    }

    .menu-dish-price {
        flex: 0 0 auto;
        white-space: nowrap;
        font-weight: 500;
        font-variant-numeric: tabular-nums;
        margin-left: 8px;
    }

    .menu-note {
        margin-top: 24px;
        font-size: 13px;
    }


    </style>
</head>
<body>
<header>
    <div class="container">
        <nav>
            @php
                $locale       = request()->route('locale') ?? config('locales.default', 'it');
                $path         = request()->path(); // es: it/menu
                // rimuove il prefisso lingua (it/..., en/..., ecc.)
                $rest         = preg_replace('#^[a-z]{2}(/|$)#', '', $path);
                $rest         = ltrim((string) $rest, '/'); // es: "menu" oppure stringa vuota
                $currentRoute = Route::currentRouteName();
            @endphp
            <div class="nav-left">
                <a class="pill" href="/{{ $locale }}">{{ __('pages.brand') }}</a>

                <a
                    href="/{{ $locale }}/ristorante"
                    class="nav-main-link {{ $currentRoute === 'ristorante' ? 'active' : '' }}"
                >
                    {{ __('pages.nav.restaurant') }}
                </a>

                <a
                    href="/{{ $locale }}/menu"
                    class="nav-main-link {{ $currentRoute === 'menu' ? 'active' : '' }}"
                >
                    {{ __('pages.nav.menu') }}
                </a>

                <a
                    href="/{{ $locale }}/dove-siamo"
                    class="nav-main-link {{ $currentRoute === 'dove-siamo' ? 'active' : '' }}"
                >
                    {{ __('pages.nav.where') }}
                </a>

                <a
                    href="/{{ $locale }}/contatti"
                    class="nav-main-link {{ in_array($currentRoute, ['contatti', 'contatti.submit']) ? 'active' : '' }}"
                >
                    {{ __('pages.nav.contacts') }}
                </a>
            </div>

<div class="nav-right">
    @php
        $restaurantPhone = config('restaurant.phone');
        // link tel: solo se il telefono è configurato,
        // altrimenti facciamo fallback alla pagina contatti
        $phoneHref = $restaurantPhone
            ? 'tel:' . preg_replace('/\D+/', '', $restaurantPhone)
            : '/' . $locale . '/contatti';
    @endphp

    <a class="pill primary" href="{{ $phoneHref }}">
        {{ __('pages.nav.book') }}
    </a>

    <div class="lang" style="display:flex; gap:8px;">
        @foreach (config('locales.supported') as $l)
            @php
                $url = '/' . $l . ($rest ? '/' . $rest : '');
            @endphp
            <a href="{{ $url }}" class="{{ $l === $locale ? 'active' : '' }}">
                {{ config('locales.labels')[$l] ?? strtoupper($l) }}
            </a>
        @endforeach
    </div>
</div>

        </nav>
    </div>
</header>

<main>
    {{ $slot }}
</main>

<footer>
    <div class="container">
        @php
            $restaurantName = config('restaurant.name', 'Ristorante');
            $addressLine    = config('restaurant.address_line');
            $phone          = config('restaurant.phone');
            $email          = config('restaurant.email');
        @endphp

        <div class="muted">
            <div>
                <strong>{{ $restaurantName }}</strong>
                @if($addressLine)
                    — {{ $addressLine }}
                @endif
                @if($phone)
                    — Tel: {{ $phone }}
                @endif
                @if($email)
                    — Email: {{ $email }}
                @endif
            </div>

            <div style="margin-top:8px; display:flex; flex-wrap:wrap; gap:8px; align-items:center;">
                <span>© {{ date('Y') }} — Tutti i diritti riservati</span>

                @php
                    $locale = request()->route('locale') ?? config('locales.default', 'it');
                @endphp

                <span style="opacity:.6;">•</span>

                <a href="/{{ $locale }}/privacy" class="muted" style="text-decoration:underline; opacity:.8;">
                    {{ __('pages.footer_privacy') }}
                </a>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
