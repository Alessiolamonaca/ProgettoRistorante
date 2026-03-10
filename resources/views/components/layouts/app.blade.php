<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    {{-- SEO + OPEN GRAPH + HREFLANG --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php
        // Locale corrente
        $locale = app()->getLocale();

        // Path richiesta (es: "it/menu") e parte dopo la lingua (es: "menu")
        $path    = request()->path();
        $rest    = preg_replace('#^[a-z]{2}(/|$)#', '', $path);
        $rest    = ltrim((string) $rest, '/');

        // Base URL
        $rootUrl = request()->root();

        // Lingue supportate + default
        $locales       = config('locales.supported', ['it']);
        $defaultLocale = config('locales.default', 'it');

        // SEO di base
        $pageTitle  = $title ?? config('restaurant.name', 'Ristorante');
        $currentUrl = request()->fullUrl();
        $metaDesc   = $metaDescription ?? null;

        // Open Graph
        $ogImage  = config('restaurant.og_image');
        $siteName = config('restaurant.site_name', config('restaurant.name', 'Ristorante'));
        $ogLocale = str_replace('-', '_', $locale) . '_' . strtoupper($locale); // es: it_IT
    @endphp

    <title>{{ $pageTitle }}</title>

    @if($metaDesc)
        <meta name="description" content="{{ $metaDesc }}">
    @endif

    <meta name="robots" content="index,follow">

    {{-- Canonical --}}
    <link rel="canonical" href="{{ $currentUrl }}">

    {{-- Hreflang per tutte le lingue --}}
    @foreach ($locales as $lang)
        @php
            $href = $rootUrl . '/' . $lang . ($rest ? '/' . $rest : '');
        @endphp
        <link rel="alternate" hreflang="{{ $lang }}" href="{{ $href }}">
    @endforeach

    {{-- x-default --}}
    <link
        rel="alternate"
        hreflang="x-default"
        href="{{ $rootUrl . '/' . $defaultLocale . ($rest ? '/' . $rest : '') }}"
    >

    {{-- Open Graph --}}
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

    {{-- STILI GLOBALI (layout, navbar, hero, pagine interne, footer) --}}
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

        /* Footer a tutta larghezza, come la navbar */
        footer .container {
            max-width: 100%;
            padding-left: 16px;
            padding-right: 16px;
        }

        /* Spazio globale sotto la navbar fissa (desktop/tablet) */
        main {
            padding-top: 72px;
        }

        /* Pagine interne (ristorante, menu, ecc.) */
        .page {
            position: relative;
            z-index: 1;
            padding-top: 48px;
            padding-bottom: 32px;
        }

        .page-header {
            margin-top: 0;
            margin-bottom: 40px;
            padding-top: 16px;
            border-top: 1px solid rgba(255,255,255,.08);
            transition: opacity .25s ease, transform .25s ease;
        }

        .page-header--collapsed {
            opacity: 0;
            transform: translateY(-12px);
            pointer-events: none;
        }

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

        .pill.primary {
            background: #f5f5f5;
            color: #111;
            border-color: transparent;
        }

        /* Utilità accessibilità */
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

        /* === HEADER + NAVBAR === */
        header {
            position: sticky;
            top: 0;
            background: linear-gradient(to bottom, #101010, #080808, #050505);
            border-bottom: 1px solid rgba(255,255,255,.06);
            box-shadow: 0 6px 18px rgba(0,0,0,.65);
            z-index: 1000;
            isolation: isolate;
        }

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

        .nav-left,
        .nav-center,
        .nav-right {
            display: flex;
            align-items: center;
        }

        .nav-left {
            flex: 0 0 auto;
            justify-content: flex-start;
            gap: 12px;
        }

        .nav-center {
            flex: 1 1 auto;
            justify-content: center;
            gap: 16px;
        }

        .nav-right {
            flex: 0 0 auto;
            justify-content: flex-end;
            gap: 12px;
        }

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

        .lang-select option {
            color: #111;
            background: #ffffff;
        }

        .lang-select:focus {
            outline: none;
            box-shadow: 0 0 0 1px rgba(255,255,255,.35);
        }

        /* Navbar / layout mobile */
        @media (max-width: 640px) {
            body {
                font-size: 15px;
            }

            header {
                position: static;
            }

            main {
                padding-top: 0;
            }

            .page {
                padding-top: 32px;
            }

            nav {
                flex-direction: column;
                align-items: stretch;
            }

            .nav-left {
                justify-content: center;
                width: 100%;
                margin-top: 4px;
            }

            .nav-left .brand {
                margin: 0 auto;
            }

            .nav-center {
                justify-content: center;
                flex-wrap: wrap;
                width: 100%;
                margin-top: 8px;
                row-gap: 6px;
            }

            .nav-right {
                justify-content: space-between;
                width: 100%;
                margin-top: 10px;
            }

            .nav-left,
            .nav-right {
                width: 100%;
                justify-content: space-between;
                margin-top: 10px;
            }

            .pill {
                padding: 7px 10px;
            }

            .pill.primary {
                font-weight: 600;
            }

            .lang-select {
                font-size: 14px;
            }
        }

        /* Navbar desktop più alta/leggibile */
        @media (min-width: 800px) {
            header .container {
                padding-top: 12px;
                padding-bottom: 12px;
            }

            nav {
                min-height: 64px;
            }

            .brand img {
                height: 100px;
            }

            .nav-center .nav-main-link {
                font-size: 20px;
                padding: 10px 20px;
            }

            .pill.primary {
                padding: 8px 16px;
                font-size: 16px;
            }

            .lang-select {
                padding: 6px 12px;
                font-size: 15px;
            }
        }

        /* === HERO GENERICA + CARD === */
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

        /* === HERO HOME CON SFONDO A CAROUSEL (nuova versione) === */
        .hero-home {
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid rgba(255,255,255,.08);
            min-height: 90vh;
            padding: 0;
            margin: 0;
            background: #050505;
            margin-top: -72px; /* compensa il padding-top del main */
        }

        .hero-bg-track {
            position: absolute;
            inset: 0;
            overflow: hidden;
            z-index: 0;
        }

        .hero-bg-slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity .6s ease;
        }

        .hero-bg-slide.is-active {
            opacity: 1;
        }

        .hero-home::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(
                900px 380px at 15% 20%,
                rgba(0,0,0,.10),
                rgba(0,0,0,.55)
            );
            z-index: 1;
        }

        .hero-content-center {
            position: relative;
            z-index: 2;
            width: 100%;
            height: 100%;
            min-height: 90vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding-top: 18vh;
        }

        .hero-heading-center,
        .hero-lead-center {
            text-align: center;
        }

        .hero-heading-center {
            margin-bottom: 12px;
        }

        .hero-lead-center {
            margin-top: 0;
        }

        .hero-bg-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 3;
            width: 40px;
            height: 40px;
            border-radius: 999px;
            border: none;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            padding: 0;
            backdrop-filter: blur(4px);
        }

        .hero-bg-arrow span {
            font-size: 50px;
            line-height: 1;
            color: rgba(255,255,255,.55);
        }

        .hero-bg-arrow-left {
            left: 24px;
        }

        .hero-bg-arrow-right {
            right: 24px;
        }

        .hero-bg-arrow:hover span {
            background: rgba(255,255,255,.09);
        }

        @media (max-width: 640px) {
            .hero-home {
                margin-top: 0;
                min-height: 75vh;
            }

            .hero-content-center {
                min-height: 75vh;
                padding-top: 16vh;
            }

            .hero-heading-center {
                font-size: 28px;
            }

            .hero-lead-center {
                font-size: 15px;
            }

            .hero-bg-arrow {
                width: 32px;
                height: 32px;
            }

            .hero-bg-arrow-left {
                left: 12px;
            }

            .hero-bg-arrow-right {
                right: 12px;
            }
        }

/* ===============    HOME INFO - BLEND CON HERO + CARD PIÙ FOTOGRAFICHE     ================== */

.home-info {
    position: relative;
    margin-top: -90px;
    padding: clamp(8rem, 11vw, 10rem) 0 clamp(5rem, 8vw, 8rem);
    overflow: hidden;
    background:
        linear-gradient(
            180deg,
            #1b130d 0%,
            #120d09 16%,
            #0d0a08 38%,
            #090909 68%,
            #070707 100%
        );
}

.home-info::before {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    top: -140px;
    height: 240px;
    background:
        linear-gradient(
            180deg,
            rgba(120, 82, 42, 0.38) 0%,
            rgba(78, 49, 24, 0.22) 36%,
            rgba(20, 14, 10, 0.10) 72%,
            rgba(7, 7, 7, 0) 100%
        );
    filter: blur(34px);
    pointer-events: none;
}

.home-info::after {
    content: "";
    position: absolute;
    inset: 0;
    background:
        radial-gradient(
            900px 360px at 14% 10%,
            rgba(214, 165, 96, 0.09),
            transparent 68%
        ),
        radial-gradient(
            760px 340px at 88% 18%,
            rgba(255, 255, 255, 0.035),
            transparent 72%
        );
    pointer-events: none;
}

.home-info .container {
    position: relative;
    z-index: 1;
    max-width: 1360px;
}

.home-info-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2.6rem;
}

.home-feature {
    position: relative;
    border-radius: 36px;
    overflow: hidden;
    background:
        linear-gradient(
            135deg,
            rgba(246, 239, 230, 0.95) 0%,
            rgba(235, 221, 203, 0.93) 100%
        );
    border: 1px solid rgba(214, 165, 96, 0.16);
    box-shadow:
        0 30px 70px rgba(0, 0, 0, 0.18),
        0 10px 28px rgba(0, 0, 0, 0.09);
    backdrop-filter: blur(8px);
    transition:
        transform 0.3s ease,
        box-shadow 0.3s ease,
        border-color 0.3s ease;
}

.home-feature:hover {
    transform: translateY(-4px);
    border-color: rgba(214, 165, 96, 0.28);
    box-shadow:
        0 36px 80px rgba(0, 0, 0, 0.22),
        0 12px 30px rgba(0, 0, 0, 0.10);
}

.home-feature::before {
    content: "";
    position: absolute;
    inset: 0;
    background:
        linear-gradient(
            120deg,
            rgba(255, 255, 255, 0.14) 0%,
            rgba(255, 255, 255, 0.04) 34%,
            rgba(138, 90, 43, 0.04) 100%
        );
    pointer-events: none;
}

.home-feature-inner {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: minmax(360px, 0.8fr) minmax(0, 1.2fr);
    gap: 1.6rem;
    align-items: stretch;
    min-height: 430px;
    padding: 1.2rem;
}

.home-feature-copy {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    text-align: left;
    padding: clamp(2rem, 4vw, 3.2rem);
    padding-right: clamp(1rem, 2vw, 1.8rem);
    border-radius: 28px;
    background:
        linear-gradient(
            180deg,
            rgba(248, 242, 235, 0.92) 0%,
            rgba(244, 236, 227, 0.86) 100%
        );
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.26);
}

.home-feature-accent {
    display: block;
    width: 82px;
    height: 4px;
    margin: 0 0 1.3rem;
    border-radius: 999px;
    background: linear-gradient(90deg, #8a5a2b, #d6a560);
    box-shadow: 0 0 18px rgba(214, 165, 96, 0.18);
}

.home-feature-title {
    margin: 0 0 1rem;
    max-width: 640px;
    font-size: clamp(1.75rem, 2.4vw, 2.45rem);
    font-weight: 800;
    line-height: 1.14;
    color: #1d140d;
    text-wrap: balance;
}

.home-feature-text {
    margin: 0;
    max-width: 640px;
    font-size: clamp(1rem, 1.08vw, 1.08rem);
    line-height: 1.9;
    color: #433427;
    text-wrap: pretty;
}

.home-feature-gallery {
    position: relative;
    display: grid;
    grid-template-columns: minmax(0, 1.28fr) minmax(170px, 0.62fr);
    gap: 1rem;
    min-height: 100%;
}

.home-feature-gallery::before {
    content: "";
    position: absolute;
    left: -30px;
    top: 0;
    bottom: 0;
    width: 120px;
    background: linear-gradient(
        90deg,
        rgba(243, 235, 225, 0.78)
        rgba(243, 235, 225, 0.52)
        rgba(243, 235, 225, 0.18)
        rgba(243, 235, 225, 0) 100%
    );
    filter: blur(12px);
    z-index: 2;
    pointer-events: none;
}

.home-feature-reverse .home-feature-gallery::before {
    left: auto;
    right: -30px;
    background: linear-gradient(
        270deg,
        rgba(243, 235, 225, 0.92) 0%,
        rgba(243, 235, 225, 0.72) 28%,
        rgba(243, 235, 225, 0.32) 58%,
        rgba(243, 235, 225, 0) 100%
    );
}

.home-feature-shot-stack {
    display: grid;
    grid-template-rows: 1fr 1fr;
    gap: 1rem;
}

.home-feature-shot {
    position: relative;
    overflow: hidden;
    border-radius: 28px;
    min-height: 170px;
    background: rgba(138, 90, 43, 0.08);
    box-shadow:
        0 14px 30px rgba(61, 42, 24, 0.12),
        inset 0 1px 0 rgba(255, 255, 255, 0.15);
}

.home-feature-shot-main {
    min-height: 100%;
}

.home-feature-shot::after {
    content: "";
    position: absolute;
    inset: 0;
    background:
        linear-gradient(
            180deg,
            rgba(255, 255, 255, 0.08) 0%,
            rgba(255, 255, 255, 0.02) 22%,
            rgba(0, 0, 0, 0.05) 100%
        );
    pointer-events: none;
}

.home-feature-shot img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
    object-position: center;
    filter: brightness(1.08) saturate(1.06) contrast(1.02);
    transition:
        transform 0.45s ease,
        filter 0.45s ease;
}

.home-feature:hover .home-feature-shot img {
    transform: scale(1.035);
    filter: brightness(1.11) saturate(1.08) contrast(1.03);
}

@media (min-width: 1000px) {
    .home-feature-reverse .home-feature-copy {
        order: 2;
    }

    .home-feature-reverse .home-feature-gallery {
        order: 1;
    }
}

@media (max-width: 1100px) {
    .home-info {
        margin-top: -60px;
        padding-top: 7rem;
    }

    .home-feature-inner {
        grid-template-columns: 1fr;
        min-height: auto;
    }

    .home-feature-copy {
        padding-right: clamp(2rem, 4vw, 3rem);
    }

    .home-feature-gallery {
        min-height: auto;
        grid-template-columns: minmax(0, 1.18fr) minmax(150px, 0.72fr);
    }

    .home-feature-gallery::before,
    .home-feature-reverse .home-feature-gallery::before {
        left: 0;
        right: 0;
        top: -20px;
        bottom: auto;
        width: auto;
        height: 90px;
        background: linear-gradient(
            180deg,
            rgba(243, 235, 225, 0.75) 0%,
            rgba(243, 235, 225, 0.22) 52%,
            rgba(243, 235, 225, 0) 100%
        );
    }

    .home-feature-reverse .home-feature-copy,
    .home-feature-reverse .home-feature-gallery {
        order: initial;
    }
}

@media (max-width: 768px) {
    .home-info {
        margin-top: -30px;
        padding: 4rem 0 3.8rem;
    }

    .home-info-grid {
        gap: 1.4rem;
    }

    .home-feature {
        border-radius: 24px;
    }

    .home-feature-inner {
        padding: 1rem;
        gap: 1rem;
    }

    .home-feature-copy {
        align-items: center;
        text-align: center;
        padding: 1.7rem 1.3rem;
        border-radius: 20px;
    }

    .home-feature-title {
        font-size: 1.42rem;
        max-width: 100%;
    }

    .home-feature-text {
        font-size: 0.98rem;
        line-height: 1.72;
        max-width: 100%;
    }

    .home-feature-accent {
        width: 58px;
        margin-bottom: 1rem;
    }

    .home-feature-gallery {
        grid-template-columns: 1fr;
        gap: 0.8rem;
    }

    .home-feature-shot-main {
        min-height: 240px;
    }

    .home-feature-shot-stack {
        grid-template-columns: 1fr 1fr;
        grid-template-rows: none;
        gap: 0.8rem;
    }

    .home-feature-shot {
        min-height: 130px;
        border-radius: 18px;
    }
}

        /* === PAGINA MENU === */
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

        /* === PAGINA RISTORANTE (STILE RUSTICO) === */
        .restaurant-sections {
            display: flex;
            flex-direction: column;
            gap: 24px;
            margin-top: 16px;
        }

        .restaurant-feature {
            position: relative;
            border-radius: 24px;
            padding: 18px;
            border: 1px solid rgba(255,255,255,.14);
            background:
                radial-gradient(
                    900px 600px at 0% 0%,
                    rgba(255,255,255,.08),
                    rgba(255,255,255,.02)
                );
            box-shadow: 0 20px 40px rgba(0,0,0,.75);
            display: grid;
            gap: 16px;
            align-items: center;
        }

        .restaurant-feature::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 24px;
            border: 1px dashed rgba(255,255,255,.08);
            pointer-events: none;
        }

        .restaurant-feature-text {
            position: relative;
            z-index: 1;
        }

        .restaurant-feature-title {
            margin: 0 0 6px;
            font-size: 20px;
            letter-spacing: .03em;
        }

        .restaurant-feature-body {
            margin: 0;
            font-size: 15px;
            line-height: 1.7;
            opacity: .92;
        }

        .restaurant-feature-image {
            position: relative;
            border-radius: 18px;
            overflow: hidden;
            min-height: 200px;
        }

        .restaurant-feature-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transform: scale(1.02);
            transition: transform .25s ease;
        }

        .restaurant-feature:hover .restaurant-feature-image img {
            transform: scale(1.06);
        }

        @media (min-width: 900px) {
            .restaurant-feature {
                grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr);
                padding: 22px;
            }

            .restaurant-feature.restaurant-feature-alt {
                grid-template-columns: minmax(0, 1fr) minmax(0, 1.1fr);
            }

            .restaurant-feature.restaurant-feature-alt .restaurant-feature-text {
                order: 2;
                text-align: right;
            }

            .restaurant-feature.restaurant-feature-alt .restaurant-feature-body {
                text-align: right;
            }

            .restaurant-feature.restaurant-feature-alt .restaurant-feature-image {
                order: 1;
            }
        }

        .restaurant-facts {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 40px;
            flex-wrap: wrap;
            margin: 24px auto 0;
            padding-top: 0;
            border-top: none;
            max-width: 100%;
            text-align: center;
        }

        .restaurant-fact {
            display: flex;
            flex-direction: column;
            gap: 2px;
            align-items: center;
            min-width: 220px;
        }

        .restaurant-fact-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .12em;
            opacity: .7;
        }

        .restaurant-fact-value {
            font-size: 14px;
        }

        /* === FOOTER === */
        footer {
            border-top: 1px solid rgba(255,255,255,.08);
            margin-top: 40px;
            padding: 20px 0;
            opacity: .9;
            font-size: 14px;
        }

        @media (min-width: 800px) {
            footer {
                font-size: 15px;
            }
        }

        .footer-layout {
            display: flex;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .footer-left {
            flex: 1 1 0;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            text-align: left;
        }

        .footer-contact {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            column-gap: 4px;
            row-gap: 0;
            text-align: left;
        }

        @media (min-width: 900px) {
            .footer-contact {
                white-space: nowrap;
                flex-wrap: nowrap;
            }
        }

        .footer-logo-wrap {
            display: inline-flex;
            align-items: center;
            margin-right: 6px;
        }

        .footer-logo {
            height: 60px;
            width: auto;
            display: block;
        }

        .footer-right {
            flex: 1 1 0;
            display: flex;
            justify-content: flex-end;
            text-align: right;
        }

        .footer-meta {
            display: inline-flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-end;
            gap: 15px;
        }

        .footer-dot {
            opacity: .6;
        }

        .footer-link {
            text-decoration: underline;
            opacity: .85;
        }

        .footer-social {
            display: flex;
            gap: 12px;
        }

        .footer-social-link {
            display: inline-flex;
            width: 30px;
            height: 30px;
            align-items: center;
            justify-content: center;
            opacity: .8;
            transition: opacity .2s ease, transform .2s ease;
        }

        .footer-social-link svg {
            width: 100%;
            height: 100%;
            display: block;
        }

        .footer-social-link:hover {
            opacity: 1;
            transform: translateY(-1px);
        }

        @media (max-width: 640px) {
            .footer-layout {
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 20px;
                text-align: center;
            }

            .footer-left,
            .footer-center,
            .footer-right {
                flex: 0 0 auto;
                justify-content: center;
                text-align: center;
            }

            .footer-contact {
                display: block;
                text-align: center;
            }

            .footer-logo-wrap {
                display: block;
                margin-bottom: 6px;
            }

            .footer-logo {
                margin: 0 auto;
            }

            .footer-social {
                justify-content: center;
            }

            .footer-meta {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    {{-- HEADER + NAVBAR --}}
    <header>
        <div class="container">
            <nav>
                @php
                    $currentRoute    = Route::currentRouteName();
                    $restaurantName  = config('restaurant.name', 'Ristorante');
                    $restaurantPhone = config('restaurant.phone');
                    $phoneHref = $restaurantPhone
                        ? 'tel:' . preg_replace('/\D+/', '', $restaurantPhone)
                        : '/' . $locale . '/contatti';
                    $logoPath = config('restaurant.logo');
                @endphp

                {{-- Logo a sinistra --}}
                <div class="nav-left">
                    <a class="brand" href="/{{ $locale }}" aria-label="{{ $restaurantName }}">
                        @if($logoPath)
                            <img src="{{ asset($logoPath) }}" alt="{{ $restaurantName }}">
                        @else
                            <span class="brand-text">{{ $restaurantName }}</span>
                        @endif
                    </a>
                </div>

                {{-- Link centrali --}}
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

                {{-- Prenota + lingua --}}
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

    {{-- CONTENUTO DELLE PAGINE --}}
    <main>
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    <footer>
        <div class="container footer-layout">
            @php
                $restaurantName = config('restaurant.name', 'Ristorante');
                $addressLine    = config('restaurant.address_line');
                $phone          = config('restaurant.phone');
                $email          = config('restaurant.email');
    
                $locale   = request()->route('locale') ?? config('locales.default', 'it');
                $logoPath = config('restaurant.logo'); // stesso logo della navbar
    
                // URL social presi dalla config
                $instagramUrl = config('restaurant.instagram');
                $facebookUrl  = config('restaurant.facebook');
            @endphp


            <div class="footer-left muted">
                <div class="footer-contact">
                    @if($logoPath)
                        <span class="footer-logo-wrap">
                            <img
                                src="{{ asset($logoPath) }}"
                                alt="{{ $restaurantName }}"
                                class="footer-logo"
                            >
                        </span>
                    @else
                        <strong>{{ $restaurantName }}</strong>
                    @endif

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
            </div>

            <div class="footer-center">
                <div class="footer-social">
                    @if($instagramUrl)
                        <a
                            href="{{ $instagramUrl }}"
                            class="footer-social-link"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="Instagram {{ $restaurantName }}"
                        >
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="3" y="3" width="18" height="18" rx="5" ry="5"
                                        fill="none" stroke="currentColor" stroke-width="1.6" />
                                <circle cx="12" cy="12" r="4.3"
                                        fill="none" stroke="currentColor" stroke-width="1.6" />
                                <circle cx="17" cy="7" r="1.2" fill="currentColor" />
                            </svg>
                        </a>
                    @endif

                    @if($facebookUrl)
                        <a
                            href="{{ $facebookUrl }}"
                            class="footer-social-link"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="Facebook {{ $restaurantName }}"
                        >
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M13.5 21v-7h2.3l.4-3h-2.7V9.1c0-1.1.4-1.6 1.7-1.6H16V4.7
                                        C15.6 4.6 14.7 4.5 13.7 4.5c-2.7 0-4.4 1.6-4.4 4.6V11H7.5v3h1.8v7h4.2z"
                                        fill="currentColor" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>

            <div class="footer-right">
                <div class="footer-meta muted">
                    <span>© {{ date('Y') }} — Tutti i diritti riservati</span>
                    <span class="footer-dot">•</span>
                    <a
                        href="/{{ $locale }}/privacy"
                        class="footer-link"
                    >
                        {{ __('pages.footer_privacy') }}
                    </a>
                </div>
            </div>
        </div>
    </footer>

    {{-- JS: HERO HOME + COLLASSO INTRO RISTORANTE --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Hero home: slider di sfondo
            (function () {
                var hero = document.querySelector('[data-hero-bg]');
                if (!hero) return;

                var slides = hero.querySelectorAll('.hero-bg-slide');
                if (!slides.length) return;

                var index = 0;
                slides[0].classList.add('is-active');
                if (slides.length === 1) return;

                function setActive(nextIndex) {
                    slides[index].classList.remove('is-active');
                    index = (nextIndex + slides.length) % slides.length;
                    slides[index].classList.add('is-active');
                }

                var prevBtn = hero.querySelector('[data-hero-bg-prev]');
                var nextBtn = hero.querySelector('[data-hero-bg-next]');

                function goPrev() { setActive(index - 1); }
                function goNext() { setActive(index + 1); }

                if (prevBtn) prevBtn.addEventListener('click', goPrev);
                if (nextBtn) nextBtn.addEventListener('click', goNext);

                var timer = setInterval(goNext, 3000);

                hero.addEventListener('mouseenter', function () {
                    clearInterval(timer);
                });

                hero.addEventListener('mouseleave', function () {
                    timer = setInterval(goNext, 3000);
                });
            })();

            // Pagina Ristorante: collasso del blocco introduttivo allo scroll
            (function () {
                var restaurantPage = document.querySelector('.page-restaurant');
                if (!restaurantPage) return;

                var headerBlock = restaurantPage.querySelector('.page-header');
                if (!headerBlock) return;

                var hideOffset = headerBlock.offsetHeight * 1.2;

                window.addEventListener('scroll', function () {
                    if (window.scrollY > hideOffset) {
                        headerBlock.classList.add('page-header--collapsed');
                    } else {
                        headerBlock.classList.remove('page-header--collapsed');
                    }
                }, { passive: true });
            })();
        });
    </script>
</body>
</html>
