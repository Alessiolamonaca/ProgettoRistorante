<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Ristorante' }}</title>

    <style>
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; margin: 0; background: #0b0b0b; color: #f3f3f3; }
        .container { max-width: 1100px; margin: 0 auto; padding: 16px; }
        header { position: sticky; top: 0; background: rgba(10,10,10,.9); backdrop-filter: blur(8px); border-bottom: 1px solid rgba(255,255,255,.08); z-index: 50; }
        nav { display:flex; gap:12px; align-items:center; justify-content:space-between; flex-wrap:wrap; }
        .nav-left, .nav-right { display:flex; gap:12px; align-items:center; flex-wrap: wrap; }
        a { color: inherit; text-decoration: none; opacity: .9; }
        a:hover { opacity: 1; }
        .pill { padding: 8px 12px; border: 1px solid rgba(255,255,255,.12); border-radius: 999px; }
        .primary { background: #f5f5f5; color:#111; border-color: transparent; }
        .lang a { font-size: 12px; padding: 6px 10px; border: 1px solid rgba(255,255,255,.12); border-radius: 999px; }
        .lang a.active { background: #f5f5f5; color:#111; border-color: transparent; }
        .hero { padding: 56px 0; border-bottom: 1px solid rgba(255,255,255,.08); background: radial-gradient(800px 300px at 20% 10%, rgba(255,255,255,.08), transparent); }
        .grid { display:grid; gap:16px; grid-template-columns: 1fr; }
        @media (min-width: 800px) { .grid { grid-template-columns: 1.2fr .8fr; } }
        .card { border: 1px solid rgba(255,255,255,.10); border-radius: 16px; padding: 16px; background: rgba(255,255,255,.03); }
        footer { border-top: 1px solid rgba(255,255,255,.08); margin-top: 40px; padding: 20px 0; opacity: .85; }
        .muted { opacity: .8; }


    .hero-image {
            border-radius: 20px;
            overflow: hidden;
            min-height: 260px;
            background-size: cover;
            background-position: center;
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
        }

        @media (max-width: 640px) {
            .gallery {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <nav>
            @php
                $locale = request()->route('locale') ?? config('locales.default', 'it');
                $path   = request()->path(); // es: it/menu
                // rimuove il prefisso lingua (it/..., en/..., ecc.)
                $rest   = preg_replace('#^[a-z]{2}(/|$)#', '', $path);
                $rest   = ltrim((string) $rest, '/'); // es: "menu" oppure stringa vuota
            @endphp

            <div class="nav-left">
                <a class="pill" href="/{{ $locale }}">{{ __('pages.brand') }}</a>

                <a href="/{{ $locale }}/ristorante">{{__('pages.nav.restaurant') }}</a>
                <a href="/{{ $locale }}/menu">{{ __('pages.nav.menu') }}</a>
                <a href="/{{ $locale }}/dove-siamo">{{ __('pages.nav.where') }}</a>
                <a href="/{{ $locale }}/contatti">{{ __('pages.nav.contacts') }}</a>
            </div>

            <div class="nav-right">
                <a class="pill primary" href="/{{ $locale }}/contatti">{{ __('pages.nav.book') }}</a>

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
        <div class="muted">
            <div><strong>Ristorante</strong> — indirizzo, telefono, email (in futuro da pannello).</div>
            <div style="margin-top:8px;">© {{ date('Y') }} — Tutti i diritti riservati</div>
        </div>
    </div>
</footer>
</body>
</html>
