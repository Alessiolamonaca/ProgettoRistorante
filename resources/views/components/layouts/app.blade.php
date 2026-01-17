<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    {{-- 
        SEZIONE: CALCOLO VARIABILI PER SEO E OPEN GRAPH
        - Impostiamo titolo pagina, descrizione, URL corrente
        - Prevediamo valori per i tag Open Graph (per condivisione social)
        - Prepariamo i dati per i tag hreflang (versioni in più lingue)
    --}}
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

    {{-- SEZIONE: TAG <title> E DESCRIZIONE --}}
    <title>{{ $pageTitle }}</title>

    @if($metaDesc)
        <meta name="description" content="{{ $metaDesc }}">
    @endif

    <meta name="robots" content="index,follow">

    {{-- SEZIONE: CANONICAL URL --}}
    <link rel="canonical" href="{{ $currentUrl }}">

    {{-- 
        SEZIONE: HREFLANG
        - Per ogni lingua supportata aggiungiamo un link alternate
        - Utile per SEO multilingua
    --}}
    @foreach ($locales as $lang)
        @php
            $href = $rootUrl . '/' . $lang . ($rest ? '/' . $rest : '');
        @endphp
        <link rel="alternate" hreflang="{{ $lang }}" href="{{ $href }}">
    @endforeach

    {{-- hreflang x-default (versione di default) --}}
    <link
        rel="alternate"
        hreflang="x-default"
        href="{{ $rootUrl . '/' . $default . ($rest ? '/' . $rest : '') }}"
    >

    {{-- 
        SEZIONE: OPEN GRAPH BASE
        - Tipologia, titolo, descrizione, URL, immagine
        - Utilizzato dai social (Facebook, WhatsApp, ecc.)
    --}}
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

    {{-- 
        SEZIONE: STILI GLOBALI
        - Layout base
        - Navbar (desktop + mobile)
        - Hero, card, gallery
        - Stili specifici per la pagina Menu
    --}}
    <style>
        /* === BASE LAYOUT E TIPOGRAFIA === */
        body {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            margin: 0;
            background: #0b0b0b;
            color: #f3f3f3;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 16px;
        }

        /* Spazio globale sotto la navbar fissa (solo desktop/tablet) */
        main {
            padding-top: 72px;  /* altezza approssimativa dell'header */
        }


        /* Spaziatura pagine interne (Il Menu, Il Ristorante, ecc.) */
        .page {
            padding-top: 48px;      /* così i contenuti partono più sotto, come la hero in home */
            padding-bottom: 32px;
        }
        

        .page-header {
            /* piccolo stacco dalla navbar */
            margin-top: 0px;
            margin-bottom: 24px;
            padding-top: 16px;
            /* riga sottile come separatore fra header blur e contenuto pagina */
            border-top: 1px solid rgba(255,255,255,.08);
        }


        /* Titoli delle sezioni nelle pagine interne (es. "Il Ristorante") */
        .page-section-title {
            margin-top: 0;
            margin-bottom: 8px;
            font-size: 20px;
        }


        .page-header h1 {
            margin: 0 0 8px;
            font-size: 32px;
            line-height: 1.2;
        }

        .page-header .muted {
            max-width: 640px;
        }

        /* Su mobile teniamo un po' meno spazio per non allungare troppo la pagina */
        @media (max-width: 640px) {
            .page {
                padding-top: 32px;
            }
        }

        .muted {
            opacity: .8;
        }

        /* === LINK E PULSANTI GENERICI === */
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
            transition:
                background .2s ease,
                color .2s ease,
                transform .15s ease,
                box-shadow .15s ease;
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

        /* === UTILITÀ ACCESSIBILITÀ (per etichette solo per screen reader) === */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        /* === HEADER E NAVBAR (DESKTOP + MOBILE) === */
        header {
            position: sticky;              /* fisso in alto */
            top: 0;
            background: rgba(10,10,10,.9);
            backdrop-filter: blur(8px);   /* resta la blur */
            border-bottom: 1px solid rgba(255,255,255,.08);
            z-index: 50;                /* sicuro sopra a tutto il resto */
        }
        
        /* SOLO NELL'HEADER: container a tutta larghezza (come avevamo già) */
        header .container {
            max-width: 100%;
        }

        nav {
            display: flex;
            gap: 16px;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        /* 3 SEZIONI DELLA NAVBAR*/
        .nav-left,
        .nav-center,
        .nav-right {
            display: flex;
            /*gap: 12px;*/
            align-items: center;
            /*flex-wrap: wrap;*/
        }

        /*Logo a sinistra*/
        .nav-left {
            flex: 0.0 auto;
            justify-content: flex-start;
            gap: 12px;
        }

        /*Link centrali*/
        .nav-center {
            flex: 1 1 auto;
            justify-content: center;
            gap: 16px;
        }

        /*Prenota + lingua a destra*/
        .nav-right {
            flex: 0.0 auto;
            justify-content: flex-end;
            gap: 12px;
        }

        /* Logo/brand: solo immagine al posto del testo */
        .brand {
            display: flex;
            align-items: center;
        }

        .brand img {
            display: block;
            height: 70px;
            width: auto;
        }

        .brand-text {
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-size: 13px;
        }


        /* Link principali di navigazione (Ristorante, Menu, Dove siamo, Contatti) */
        .nav-main-link {
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid transparent;
            font-size: 14px;
            transition:
                background .2s ease,
                border-color .2s ease,
                color .2s ease;
        }

        .nav-main-link.active {
            border-color: rgba(255,255,255,.45);
            background: rgba(255,255,255,.10);
        }

        /* === SELETTORE LINGUA A TENDINA (valido per desktop e mobile) === */
        .lang-dropdown {
            display: flex;
            align-items: center;
        }

        .lang-select {
            background: transparent;
            color: #f3f3f3;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,.18);
            padding: 6px 12px;
            font-size: 13px;
            line-height: 1.2;
        }

        /* Rendere leggibile le opzioni quando apri il menu (testo scuro su sfondo chiaro) */
        .lang-select option {
            color: #111;
            background: #ffffff;
        }

        .lang-select:focus {
            outline: none;
            box-shadow: 0 0 0 1px rgba(255,255,255,.35);
        }

        /* === RESPONSIVE: NAVBAR E TIPOGRAFIA MOBILE === */
        @media (max-width: 640px) {
            body {
                font-size: 15px;
            }

            /* Su mobile il header non resta sticky in alto */
            header {
                position: static;

           /* E non serve il padding extra sul main */
            main {
                padding-top: 72px;
            }

            /* Impiliamo le 3 sezioni una sotto l'altra */
            nav {
                flex-direction: column;
                align-items: stretch;
            }

            /* 1) Logo centrato */
            .nav-left {
                justify-content: center;
                width: 100%;
                margin-top: 4px;
            }

            .nav-left .brand {
                margin: 0 auto;
            }

            /* 2) Linke centrati sotto il logo */
            .nav-center {
                justify-content: center;
                flex: wrap;
                width: 100%;
                margin-top: 8px;
                row-gap: 6px;
            }

            /* 3) Prenota + lingua in basso, uno a sinistra e uno a destra */
            .nav-right {
                justify-content: space-between;
                width: 100%;
                margin-top: 10px;
            }

            /* Nav sinistra e destra occupano tutta la larghezza e vanno a righe */
            .nav-left,
            .nav-right {
                width: 100%;
                justify-content: space-between;
                margin-top: 10px;
                /*gap: 8px;*/
            }

            .pill {
                padding: 7px 10px;
            }

            .primary {
                font-weight: 600;
            }

            .lang-select {
                font-size: 14px;
            }
        }

        /* === HERO GENERICA (usata nelle varie pagine) === */
        .hero {
            padding: 56px 0;
            border-bottom: 1px solid rgba(255,255,255,.08);
            background: radial-gradient(
                800px 300px at 20% 10%,
                rgba(255,255,255,.08),
                transparent
            );
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

        /* Card generiche (per box contenuti, sezioni, ecc.) */
        .card {
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 16px;
            padding: 16px;
            background: rgba(255,255,255,.03);
            transition:
                transform .2s ease,
                box-shadow .2s ease,
                border-color .2s ease,
                background .2s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(0,0,0,.55);
            border-color: rgba(255,255,255,.16);
            background: rgba(255,255,255,.04);
        }

        /* === HERO SPECIFICA HOME PAGE (heading, testo, bottoni) === */
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

        /* === IMMAGINI HERO E GALLERY FOTO === */
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
            transition:
                transform .2s ease,
                box-shadow .2s ease,
                opacity .2s ease;
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

        /* === FOOTER SITO === */
        footer {
            border-top: 1px solid rgba(255,255,255,.08);
            margin-top: 40px;
            padding: 20px 0;
            opacity: .85;
        }

        /* === STILI SPECIFICI PAGINA MENU === */
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

        /* === NAVBAR PIÙ ALTA E PIÙ LEGGIBILE SU DESKTOP === */
        @media (min-width: 800px) {
            /* più spazio verticale nel container dell'header */
            header .container {
                padding-top: 12px;
                padding-bottom: 12px;
            }
        
            /* altezza minima della barra di navigazione */
            nav {
                min-height: 64px;
            }
        
            /* logo un po' più grande */
            .brand img {
                height: 100px;
            }
        
            /* link centrali più "importanti" */
            .nav-center .nav-main-link {
                font-size: 15px;
                padding: 6px 14px;
            }
        
            /* pulsante Prenota più grande */
            .pill.primary {
                padding: 8px 16px;
                font-size: 14px;
            }
        
            /* select lingua più comoda da cliccare */
            .lang-select {
                padding: 6px 12px;
                font-size: 13px;
            }
        }

        /* --- Home: sezione informativa con 3 card */
        .home-info {
            padding-top: 24px;
            padding-bottom: 32px;
        }

        /* Titolo delle card nella sezione home */
        .home-card-title {
            margin-top: 0;
            margin-bottom: 8px;
            font-size: 18px;
        }

        /* Su desktop la griglia .grid-3 va a tre colonne */
        @media (min-width: 800px){
            .grid-3 {
                grid-template-columns: repeat(3, minmax(0,1fr));
            }
        }

        /* --- Menu: adattamento piatti/prezzi su schermi piccoli --- */
        @media (max-width: 480px) {
            .menu-dish-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }
        
            .menu-dish-price {
                margin-top: 2px;
            }
        }
    </style>
</head>
<body>
    {{-- 
        SEZIONE: HEADER + NAVBAR PRINCIPALE
        - Contiene il logo
        - I link principali di navigazione
        - Il pulsante di prenotazione
        - Il selettore lingua a tendina (desktop + mobile)
    --}}
<header>
    
    <div class="container">
        <nav>
            @php
                // Lingua corrente e path senza prefisso lingua
                $locale        = request()->route('locale') ?? config('locales.default', 'it');
                $path          = request()->path(); // es: "it/menu"
                $rest          = preg_replace('#^[a-z]{2}(/|$)#', '', $path);
                $rest          = ltrim((string) $rest, '/');
                $currentRoute  = Route::currentRouteName();

                // Dati ristorante
                $restaurantName  = config('restaurant.name', 'Ristorante');
                $restaurantPhone = config('restaurant.phone');

                // Link per il pulsante "Prenota"
                $phoneHref = $restaurantPhone
                    ? 'tel:' . preg_replace('/\D+/', '', $restaurantPhone)
                    : '/' . $locale . '/contatti';
            @endphp

            {{-- COLONNA SINISTRA: SOLO LOGO --}}
            <div class="nav-left">
                <a class="brand" href="/{{ $locale }}" aria-label="{{ $restaurantName }}">
                    @php
                        $logoPath = config('restaurant.logo'); // es: images/logo-torre-blaga.svg
                    @endphp
            
                    @if($logoPath)
                        {{-- Logo immagine --}}
                        <img src="{{ asset($logoPath) }}" alt="{{ $restaurantName }}">
                    @else
                        {{-- Fallback: testo brand se il logo non è configurato correttamente --}}
                        <span class="brand-text">{{ $restaurantName }}</span>
                    @endif
                </a>
            </div>
            

            {{-- COLONNA CENTRALE: LINK PRINCIPALI --}}
            <div class="nav-center">
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

            {{-- COLONNA DESTRA: PRENOTA + LINGUA A TENDINA --}}
            <div class="nav-right">
                <a class="pill primary" href="{{ $phoneHref }}">
                    {{ __('pages.nav.book') }}
                </a>

                <div class="lang-dropdown">
                    <label for="language-switcher" class="sr-only">
                        {{ __('pages.nav.language') ?? 'Lingua' }}
                    </label>

                    <select
                        id="language-switcher"
                        class="lang-select"
                        onchange="if (this.value) window.location.href = this.value;"
                    >
                        @foreach (config('locales.supported') as $l)
                            @php
                                $url = '/' . $l . ($rest ? '/' . $rest : '');
                            @endphp
                            <option
                                value="{{ $url }}"
                                {{ $l === $locale ? 'selected' : '' }}
                            >
                                {{ config('locales.labels')[$l] ?? strtoupper($l) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </nav>
    </div>
</header>

    {{-- 
        SEZIONE: CONTENUTO PRINCIPALE DINAMICO
        - Qui viene iniettato il contenuto delle singole pagine (slot Blade)
    --}}
    <main>
        {{ $slot }}
    </main>

    {{-- 
        SEZIONE: FOOTER
        - Mostra nome ristorante, indirizzo, telefono, email
        - Link alla pagina privacy nella lingua corrente
    --}}
    <footer>
        <div class="container">
            @php
                $restaurantName = config('restaurant.name', 'Ristorante');
                $addressLine    = config('restaurant.address_line');
                $phone          = config('restaurant.phone');
                $email          = config('restaurant.email');

                $locale = request()->route('locale') ?? config('locales.default', 'it');
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

                    <span style="opacity:.6;">•</span>

                    <a
                        href="/{{ $locale }}/privacy"
                        class="muted"
                        style="text-decoration:underline; opacity:.8;"
                    >
                        {{ __('pages.footer_privacy') }}
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
