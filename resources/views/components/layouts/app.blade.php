<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    {{-- SEO + OPEN GRAPH + HREFLANG --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php
        $locale = app()->getLocale();

        $path = request()->path();
        $rest = preg_replace('#^[a-z]{2}(/|$)#', '', $path);
        $rest = ltrim((string) $rest, '/');

        $rootUrl = request()->root();

        $locales = config('locales.supported', ['it']);
        $defaultLocale = config('locales.default', 'it');

        $pageTitle = $title ?? config('restaurant.name', 'Ristorante');
        $currentUrl = request()->fullUrl();
        $metaDesc = $metaDescription ?? null;

        $ogImage = config('restaurant.og_image');
        $siteName = config('restaurant.site_name', config('restaurant.name', 'Ristorante'));
        $ogLocale = str_replace('-', '_', $locale) . '_' . strtoupper($locale);
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

    <style>
        /* =========================
        BASE LAYOUT E TIPOGRAFIA
        ========================= */
        body {
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
            background: #0b0b0b;
            color: #f3f3f3;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 16px;
        }

        footer .container {
            max-width: 100%;
            padding-left: 16px;
            padding-right: 16px;
        }

        main {
            padding-top: 72px;
        }

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
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            transition: opacity 0.25s ease, transform 0.25s ease;
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
            opacity: 0.8;
        }

        /* =========================
        LINK E PULSANTI
        ========================= */
        a {
            color: inherit;
            text-decoration: none;
            opacity: 0.9;
            transition: opacity 0.2s ease;
        }

        a:hover {
            opacity: 1;
        }

        .pill {
            padding: 8px 12px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 999px;
            transition:
                background 0.2s ease,
                color 0.2s ease,
                transform 0.15s ease,
                box-shadow 0.15s ease;
        }

        .pill:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.45);
        }

        .pill.primary {
            background: #f5f5f5;
            color: #111;
            border-color: transparent;
        }

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

        /* =========================
        HEADER + NAVBAR
        ========================= */
        header {
            position: sticky;
            top: 0;
            z-index: 1000;
            isolation: isolate;
            background: linear-gradient(to bottom, #101010, #080808, #050505);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.65);
        }

        header .container {
            max-width: 100%;
        }

        nav {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
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
            width: auto;
            height: 70px;
        }

        .brand-text {
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .nav-main-link {
            padding: 6px 10px;
            border: 1px solid transparent;
            border-radius: 999px;
            font-size: 14px;
            transition:
                background 0.2s ease,
                border-color 0.2s ease,
                color 0.2s ease;
        }

        .nav-main-link.active {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.45);
        }

        .lang-dropdown {
            display: flex;
            align-items: center;
        }

        .lang-select {
            padding: 6px 12px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 999px;
            background: transparent;
            color: #f3f3f3;
            font-size: 13px;
            line-height: 1.2;
        }

        .lang-select option {
            background: #ffffff;
            color: #111;
        }

        .lang-select:focus {
            outline: none;
            box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.35);
        }

        /* =========================
        HERO GENERICA + CARD
        ========================= */
        .hero {
            padding: 56px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            background: radial-gradient(
                800px 300px at 20% 10%,
                rgba(255, 255, 255, 0.08),
                transparent
            );
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .card {
            padding: 16px;
            border: 0;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.03);
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.04);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.55);
        }

        .hero-heading {
            margin: 0 0 12px;
            font-size: 40px;
            line-height: 1.1;
        }

        .hero-lead {
            max-width: 560px;
            margin: 0 0 18px;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .hero-image {
            min-height: 260px;
            overflow: hidden;
            border-radius: 20px;
            background-position: center;
            background-size: cover;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hero-image:hover {
            transform: scale(1.01);
            box-shadow: 0 18px 36px rgba(0, 0, 0, 0.7);
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-top: 12px;
        }

        .gallery img {
            display: block;
            width: 100%;
            height: 90px;
            border-radius: 12px;
            object-fit: cover;
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                opacity 0.2s ease;
        }

        .gallery img:hover {
            transform: scale(1.03);
            opacity: 0.95;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.6);
        }

        /* =========================
        HERO HOME CON CAROUSEL
        ========================= */
        .hero-home {
            position: relative;
            min-height: 90vh;
            margin: 0;
            margin-top: -72px;
            padding: 0;
            overflow: hidden;
            background: #050505;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .hero-bg-track {
            position: absolute;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }

        .hero-bg-slide {
            position: absolute;
            inset: 0;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            opacity: 0;
            transition: opacity 0.6s ease;
        }

        .hero-bg-slide.is-active {
            opacity: 1;
        }

        .hero-home::after {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 1;
            background: radial-gradient(
                900px 380px at 15% 20%,
                rgba(0, 0, 0, 0.1),
                rgba(0, 0, 0, 0.55)
            );
        }

        .hero-content-center {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            width: 100%;
            min-height: 90vh;
            height: 100%;
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
            z-index: 3;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            padding: 0;
            border: none;
            border-radius: 999px;
            background: transparent;
            cursor: pointer;
            transform: translateY(-50%);
            backdrop-filter: blur(4px);
        }

        .hero-bg-arrow span {
            font-size: 50px;
            line-height: 1;
            color: rgba(255, 255, 255, 0.55);
        }

        .hero-bg-arrow-left {
            left: 24px;
        }

        .hero-bg-arrow-right {
            right: 24px;
        }

        .hero-bg-arrow:hover span {
            background: rgba(255, 255, 255, 0.09);
        }
    
        /* =========================
            HOME INFO
        ========================= */
    
        .home-info {
            position: relative;
            margin-top: -36px;
            padding: clamp(5rem, 8vw, 7rem) 0 clamp(5rem, 8vw, 7rem);
            overflow: hidden;
            background: linear-gradient(
                180deg,
                #070707 0%,
                #0a0a0a 38%,
                #090909 68%,
                #070707 100%
            );
        }
        
        .home-info::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(
                    900px 260px at 50% 0%,
                    rgba(255, 255, 255, 0.025),
                    transparent 72%
                ),
                radial-gradient(
                    700px 260px at 18% 30%,
                    rgba(255, 255, 255, 0.015),
                    transparent 72%
                ),
                radial-gradient(
                    700px 260px at 82% 35%,
                    rgba(255, 255, 255, 0.012),
                    transparent 72%
                );
            pointer-events: none;
        }
        
        .home-info .container {
            position: relative;
            z-index: 1;
            max-width: 1280px;
        }
        
        .home-info-grid {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .home-futere {
            width: 100%;
            background: transparent;
            border: 0;
            border-radius: 0;
            box-shadow: none;
            overflow: visible;
            padding: 0.6rem 0;
        }

        .home-feature + .home-feature{
            margin-top: clamp(4.5rem, 7vw, 7rem);
        }
        
        /* NIENTE CARD VISIBILE */
        .home-feature {
            width: 100%;
            background: transparent;
            border: 0;
            border-radius: 0;
            box-shadow: none;
            overflow: visible;
        }
        
        .home-feature::before,
        .home-feature::after {
            display: none;
            content: none;
        }
        
        .home-feature-inner {
            width: min(100%, 1180px);
            margin: 0 auto;
            display: grid;
            grid-template-columns: minmax(320px, 0.88fr) minmax(0, 1.12fr);
            align-items: center;
            gap: clamp(3rem, 5vw, 5rem);
            min-height: 460px;
            padding: 0;
        }
        
        .home-feature-copy {
            max-width: 540px;
            padding: 0 0.8rem;
            background: none;
            border: 0;
            border-radius: 0;
            box-shadow: none;
            text-align: left;
        }
        
        .home-feature-accent {
            display: block;
            width: 82px;
            height: 4px;
            margin: 0 0 1.25rem;
            border-radius: 999px;
            background: linear-gradient(90deg, #b7a187, #e1d2bf);
            box-shadow: 0 0 14px rgba(225, 210, 191, 0.10);
        }
        
        .home-feature-title {
            margin: 0 0 1.25rem;
            color: #f4efe8;
            font-size: clamp(1.8rem, 2.5vw, 2.5rem);
            font-weight: 800;
            line-height: 1.12;
            text-wrap: balance;
        }
        
        .home-feature-text {
            margin: 0;
            color: rgba(244, 239, 232, 0.82);
            font-size: clamp(1rem, 1.06vw, 1.08rem);
            line-height: 1.9;
            text-wrap: pretty;
        }
        
        /* GALLERY PIÙ PULITA */
        .home-feature-gallery {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 460px;
        }
        
        .home-feature-gallery::before {
            content: "";
            position: absolute;
            top: 50%;
            left: -24px;
            width: 110px;
            height: 70%;
            transform: translateY(-50%);
            z-index: 2;
            background: linear-gradient(
                90deg,
                rgba(10, 10, 10, 0.92) 0%,
                rgba(10, 10, 10, 0.72) 32%,
                rgba(10, 10, 10, 0.24) 68%,
                rgba(10, 10, 10, 0) 100%
            );
            filter: blur(12px);
            pointer-events: none;
        }
        
        .home-feature-reverse .home-feature-gallery::before {
            left: auto;
            right: -24px;
            background: linear-gradient(
                270deg,
                rgba(10, 10, 10, 0.92) 0%,
                rgba(10, 10, 10, 0.72) 32%,
                rgba(10, 10, 10, 0.24) 68%,
                rgba(10, 10, 10, 0) 100%
            );
        }
        
        .home-feature-shot-stack {
            width: min(100%, 560px);
            min-height: 340px;
            margin: 0 auto;
        }
        
        .home-feature-shot {
            position: relative;
            min-height: 170px;
            overflow: hidden;
            border-radius: 24px;
            background: transparent;
            box-shadow: none;
            align-self: center;
        }
        
        .home-feature-shot-main {
            min-height: 420px;
        }
        
        .home-feature-shot::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(
                180deg,
                rgba(255, 255, 255, 0.04) 0%,
                rgba(255, 255, 255, 0.01) 22%,
                rgba(0, 0, 0, 0.12) 100%
            );
            pointer-events: none;
        }
        
        .home-feature-shot img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            filter: brightness(1.03) saturate(0.95) contrast(1.02);
            transition: transform 0.45s ease, filter 0.45s ease;
        }
        
        .home-feature:hover .home-feature-shot img {
        transform: scale(1.02);
        filter: brightness(1.05) saturate(0.97) contrast(1.03);
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
            margin-top: -18px;
            padding-top: 4.8rem;
        }
    
        .home-feature-inner {
            grid-template-columns: 1fr;
            gap: 1.6rem;
            min-height: auto;
        }
    
        .home-feature-copy {
            max-width: 100%;
        }
    
        .home-feature-gallery {
            min-height: auto;
            justify-content: center;
        }
    
        .home-feature-gallery::before,
        .home-feature-reverse .home-feature-gallery::before {
            left: 0;
            right: 0;
            top: -14px;
            bottom: auto;
            width: auto;
            height: 72px;
            background: linear-gradient(
                180deg,
                rgba(10, 10, 10, 0.86) 0%,
                rgba(10, 10, 10, 0.28) 56%,
                rgba(10, 10, 10, 0) 100%
            );
        }
    
        .home-feature-reverse .home-feature-copy,
        .home-feature-reverse .home-feature-gallery {
            order: initial;
        }
    
        .home-feature-shot-main {
            width: min(100%, 620px);
            min-height: 320px;
        }
    }
    
    @media (max-width: 768px) {
        .home-info {
            margin-top: 0;
            padding: 3.8rem 0;
        }
    
        .home-info-grid {
            gap: 2rem;
        }
    
        .home-feature-inner {
            gap: 1rem;
        }
    
        .home-feature-copy {
            text-align: center;
        }
    
        .home-feature-accent {
            margin: 0 auto 1rem;
            width: 58px;
        }
    
        .home-feature-title {
            font-size: 1.42rem;
        }
    
        .home-feature-text {
            font-size: 0.98rem;
            line-height: 1.72;
        }
    
        .home-feature-gallery {
            justify-content: center;
        }
    
        .home-feature-shot-main {
            width: 100%;
            min-height: 240px;
        }
    
        .home-feature-shot-stack {
            grid-template-columns: 1fr 1fr;
            grid-template-rows: none;
            gap: 0.8rem;
        }
    
        .home-feature-shot {
            border-radius: 18px;
        }
    }

        .home-feature-shot-main {
            min-height: 100%;
        }

        .home-feature-shot::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(
                180deg,
                rgba(255, 255, 255, 0.04) 0%,
                rgba(255, 255, 255, 0.01) 24%,
                rgba(0, 0, 0, 0.10) 100%
            );
            pointer-events: none;
        }

        .home-feature-shot img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            filter: brightness(1.02) saturate(0.94) contrast(1.02);
            transition:
                transform 0.45s ease,
                filter 0.45s ease;
        }

        .home-feature:hover .home-feature-shot img {
            transform: scale(1.02);
            filter: brightness(1.04) saturate(0.96) contrast(1.03);
        }

        /* =========================
        PAGINA MENU
        Header trasparente + card una sotto l'altra
        ========================= */
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
            align-items: flex-start;
            justify-content: space-between;
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
            margin-left: 8px;
            font-weight: 500;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }

        .menu-note {
            max-width: 900px;
            margin: 80px auto 0;
            font-size: 13px;
            text-align: center;
            line-height: 1.7;
        }

        .page-menu .page-header {
        text-align: center;
    }

        .page-menu .page-header,
        .page-menu .page-header.card {
            background: transparent !important;
            border: 0 !important;
            box-shadow: none !important;
            padding-top: 0;
            text-align: center;
            margin-bottom: 40px;
        }
        
        .page-menu .page-header::before,
        .page-menu .page-header::after {
            display: none;
            content: none;
        }

        .page-menu .page-header h1{
            text-align: center;
            margin: 0 0 18px;
        }

        .page-menu .page-header .muted{
            max-width: 760px;
            margin: 0 auto;
            text-align: center;
        }
        
        .page-menu .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 18px;
            max-width: 980px;
            margin: 0 auto;
        }

        .page-menu .card {
        background: rgba(34, 28, 22, 0.42) !important;
        border: 1px solid rgba(201, 178, 145, 0.20) !important;
        box-shadow: none !important;
        backdrop-filter: blur(2px);
    }
    
    .page-menu .card:hover {
        background: rgba(34, 28, 22, 0.52) !important;
        border-color: rgba(201, 178, 145, 0.28) !important;
        box-shadow: none !important;
    }
    
    .page-menu .menu-note {
        max-width: 900px;
        margin: 44px auto 0;
        text-align: center;
        line-height: 1.7;
    }
        
        @media (min-width: 800px) {
            .page-menu .grid {
                grid-template-columns: 1fr;
            }
        }

        /* =========================
        PAGINA RISTORANTE
        ========================= */
        .restaurant-sections {
            display: flex;
            flex-direction: column;
            gap: 250px;
            margin-top: 30px;
        }

        .restaurant-feature {
            position: relative;
            display: grid;
            align-items: center;
            gap: 100px;
            padding: 0;
            border: 0;
            border-radius: 0;
            background: transparent;
            box-shadow: none;
        }
        
        .restaurant-feature::before {
            display: none;
            content: none;
        }
        
        .restaurant-feature-text {
            position: relative;
            z-index: 1;
        }
        
        .restaurant-feature-title {
            margin: 0 0 5px;
            font-size: 20px;
            letter-spacing: 0.03em;
        }
        
        .restaurant-feature-body {
            margin: 0;
            font-size: 15px;
            line-height: 1.9;
            opacity: 0.92;
        }
        
        .restaurant-feature-image {
            position: relative;
            min-height: 280px;
            overflow: hidden;
            border-radius: 24px;
        }
        
        .restaurant-feature-image img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: none;
            transition: transform 0.25s ease;
        }
        
        .restaurant-feature:hover .restaurant-feature-image img {
            transform: scale(1.03);
        }

        .restaurant-facts {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: center;
            gap: 72px;
            max-width: 100%;
            margin: 140px auto 0;
            padding-top: 0;
            border-top: none;
            text-align: center;
        }

        .restaurant-fact {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
            min-width: 220px;
        }

        .restaurant-fact-label {
            font-size: 12px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            opacity: 0.7;
        }

        .restaurant-fact-value {
            font-size: 14px;
        }

        /* =========================
        MENU: sfondo unito alla navbar
            ========================= */
        body:has(.page-menu) header {
            background: linear-gradient(
                180deg,
                rgba(20, 17, 13, 0.92) 0%,
                rgba(20, 17, 13, 0.72) 45%,
                rgba(20, 17, 13, 0.00) 100%
            );
            border-bottom: 0;
            box-shadow: none;
        }
        
        body:has(.page-menu) main {
            padding-top: 0;
        }
        
        .page-menu {
            padding-top: 120px;
        }
        
        .page-menu .page-header,
        .page-menu .page-header.card {
            border-top: 0 !important;
            background: transparent !important;
            box-shadow: none !important;
        }

        /* =========================
        PAGINA MENU: SFONDO IMMAGINE
            ========================= */
        .page-menu {
            position: relative;
            overflow: hidden;
        }
        
        .page-menu::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background:
                linear-gradient(
                    180deg,
                    rgba(20, 17, 13, 0.96) 0%,
                    rgba(20, 17, 13, 0.78) 12%,
                    rgba(20, 17, 13, 0.52) 24%,
                    rgba(20, 17, 13, 0.34) 50%,
                    rgba(20, 17, 13, 0.52) 76%,
                    rgba(20, 17, 13, 0.78) 88%,
                    rgba(20, 17, 13, 0.96) 100%
                ),
                url('{{ asset('images/menu.jpg') }}') center center / cover no-repeat;
            opacity: 0.62;
            filter: brightness(1.18) saturate(1.02);
        }
        
        .page-menu > * {
            position: relative;
            z-index: 1;
        }

        /* =========================
        PAGINA DOVE SIAMO
            ========================= */
        .page-where {
            position: relative;
            overflow: hidden;
        }
        
        .page-where::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background:
                linear-gradient(
                    180deg,
                    rgba(20, 17, 13, 0.96) 0%,
                    rgba(20, 17, 13, 0.78) 12%,
                    rgba(20, 17, 13, 0.52) 24%,
                    rgba(20, 17, 13, 0.34) 50%,
                    rgba(20, 17, 13, 0.52) 76%,
                    rgba(20, 17, 13, 0.78) 88%,
                    rgba(20, 17, 13, 0.96) 100%
                ),
                url('{{ asset('images/mappa.png') }}') center center / cover no-repeat;
            opacity: 0.62;
            filter: brightness(1.18) saturate(1.02);
        }
        
        .page-where > * {
            position: relative;
            z-index: 1;
        }
        
        .page-where .page-header,
        .page-where .page-header.card {
            max-width: 1100px;
            margin: 0 auto 48px;
            padding-top: 0;
            text-align: center;
            background: transparent !important;
            border: 0 !important;
            box-shadow: none !important;
        }
        
        .page-where .page-header::before,
        .page-where .page-header::after {
            display: none;
            content: none;
        }
        
        .page-where .page-header h1 {
            margin: 0 0 18px;
            text-align: center;
        }
        
        .page-where .page-header .muted {
            max-width: 760px;
            margin: 0 auto;
            text-align: center;
        }
        
        .page-where .grid {
            display: flex;
            justify-content: center;
        }
        
        .page-where .card {
            width: min(100%, 680px);
            margin: 0 auto;
            padding: 34px;
            background: rgba(34, 28, 22, 0.28) !important;
            border: 1px solid rgba(201, 178, 145, 0.16) !important;
            box-shadow: none !important;
            backdrop-filter: blur(2px);
            text-align: center;
        }
        
        .page-where .card h2,
        .page-where .card h3 {
            margin: 0 0 22px;
            font-size: 30px;
            text-align: center;
        }
        
        .page-where .card p {
            line-height: 1.8;
            text-align: center;
        }

        .page-where .card {
            text-align: center;
        }

        .page-where .hero-actions,
        .page-where .card .hero-actions {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            flex-wrap: wrap !important;
            width: 100% !important;
            margin: 24px 0 0 !important;
            gap: 14px !important;
            text-align: center !important;
        }
        
        .page-where .hero-actions > *,
        .page-where .card .hero-actions > * {
            margin: 0 !important;
        }

        .page-where .card .hero-actions a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .page-where .page-header,
            .page-where .page-header.card {
                margin-bottom: 34px;
            }
        
            .page-where .card {
                width: 100%;
                padding: 24px;
            }
        
            .page-where .card h2,
            .page-where .card h3 {
                font-size: 24px;
            }
        }

        /* =========================
        PAGINA CONTATTI
           ========================= */
        .page-contacts .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 30px;
            align-items: center;
        }
        
        .page-contacts .grid > * {
            min-width: 0;
        }
        
        .page-contacts .card {
            overflow: hidden;
        }
        
        .page-contacts form {
            width: 100%;
            min-width: 0;
        }
        
        .page-contacts label {
            display: block;
            margin-bottom: 15px;
        }
        
        .page-contacts input,
        .page-contacts textarea,
        .page-contacts select {
            display: block;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            font: inherit;
        }
        
        .page-contacts textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .page-contacts button {
            box-sizing: border-box;
            font: inherit;
        }
        
        @media (max-width: 799px) {
            .page-contacts .grid {
                grid-template-columns: 1fr;
                align-items: start;
            }
        }

        /* =========================
        PAGINA RISTORANTE: HEADER CENTRATO + PIÙ SPAZIO TRA CARD
        ======================== */
        .page-restaurant .page-header {
            text-align: center;
            margin-bottom: 56px;
        }
        
        .page-restaurant .page-header .muted {
            max-width: 400px;
            margin: 60px auto;
            text-align: center;
        }
        
        .page-restaurant .page-header h1 {
            margin: 0 0 10px;
        }
        
        .page-restaurant .page-section-title {
            margin-bottom: 50px;
        }
        
        .page-restaurant .restaurant-sections {
            gap: 500px;
            margin-top: 60px;
        }
        
        @media (max-width: 768px) {
            .page-restaurant .page-header {
                margin-bottom: 48px;
            }
        
            .page-restaurant .restaurant-sections {
                gap: 24px;
                margin-top: 20px;
            }
        }

        /* =========================
        HEADER PAGINA CONTATTI
            ========================= */
        .page-contacts .page-header {
            text-align: center;
            margin-bottom: 100px;
        }
        
        .page-contacts .page-header h1 {
            margin: 0 0 18px;
        }
        
        .page-contacts .page-header .muted {
            max-width: 760px;
            margin: 18px auto;
        }

        /* =========================
        FOOTER
        ========================= */
        footer {
            margin-top: 40px;
            padding: 20px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            font-size: 14px;
            opacity: 0.9;
        }

        .footer-layout {
            display: flex;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .footer-left {
            display: flex;
            flex: 1 1 0;
            align-items: center;
            justify-content: flex-start;
            text-align: left;
        }

        .footer-contact {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            column-gap: 4px;
            row-gap: 0;
            text-align: left;
        }

        .footer-logo-wrap {
            display: inline-flex;
            align-items: center;
            margin-right: 6px;
        }

        .footer-logo {
            display: block;
            width: auto;
            height: 60px;
        }

        .footer-right {
            display: flex;
            flex: 1 1 0;
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
            opacity: 0.6;
        }

        .footer-link {
            text-decoration: underline;
            opacity: 0.85;
        }

        .footer-social {
            display: flex;
            gap: 12px;
        }

        .footer-social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            opacity: 0.8;
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        .footer-social-link svg {
            display: block;
            width: 100%;
            height: 100%;
        }

        .footer-social-link:hover {
            opacity: 1;
            transform: translateY(-1px);
        }

        /* =========================
        RESPONSIVE
        ========================= */
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
                padding: 10px 20px;
                font-size: 20px;
            }

            .pill.primary {
                padding: 8px 16px;
                font-size: 16px;
            }

            .lang-select {
                padding: 6px 12px;
                font-size: 15px;
            }

            .grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .hero .grid {
                grid-template-columns: 1.2fr 0.8fr;
                align-items: center;
            }

            footer {
                font-size: 15px;
            }
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

            .footer-contact {
                flex-wrap: nowrap;
                white-space: nowrap;
            }
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
                margin-top: -45px;
                padding-top: 6.5rem;
            }

            .home-feature-inner {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .home-feature-gallery {
                grid-template-columns: minmax(0, 1.2fr) minmax(140px, 0.8fr);
                min-height: auto;
            }

            .home-feature-gallery::before,
            .home-feature-reverse .home-feature-gallery::before {
                top: -20px;
                right: 0;
                bottom: auto;
                left: 0;
                width: auto;
                height: 90px;
                background: linear-gradient(
                    180deg,
                    rgba(18, 18, 18, 0.86) 0%,
                    rgba(18, 18, 18, 0.28) 54%,
                    rgba(18, 18, 18, 0) 100%
                );
            }

            .home-feature-reverse .home-feature-copy,
            .home-feature-reverse .home-feature-gallery {
                order: initial;
            }
        }

        @media (max-width: 768px) {
            .hero-heading {
                font-size: 30px;
            }

            .hero-lead {
                font-size: 15px;
            }

            .home-info {
                margin-top: -20px;
                padding: 4rem 0 3.8rem;
            }

            .home-info-grid {
                gap: 1.4rem;
            }

            .home-feature {
                border-radius: 24px;
            }

            .home-feature-inner {
                gap: 1rem;
                padding: 1rem;
            }

            .home-feature-copy {
                align-items: center;
                padding: 1.6rem 1.2rem;
                text-align: center;
            }

            .home-feature-title {
                max-width: 100%;
                font-size: 1.42rem;
            }

            .home-feature-text {
                max-width: 100%;
                font-size: 0.98rem;
                line-height: 1.72;
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
                width: 100%;
                justify-content: center;
                margin-top: 4px;
            }

            .nav-left .brand {
                margin: 0 auto;
            }

            .nav-center {
                width: 100%;
                flex-wrap: wrap;
                justify-content: center;
                row-gap: 6px;
                margin-top: 8px;
            }

            .nav-right {
                width: 100%;
                justify-content: space-between;
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

            .gallery {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-home {
                min-height: 75vh;
                margin-top: 0;
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

            .footer-social,
            .footer-meta {
                justify-content: center;
            }
        }

        /* =========================
        TEMA AGRITURISMO SCURO REFINED
           ========================= */
        :root {
            --agri-bg: #14110d;
            --agri-bg-2: #1b1611;
            --agri-surface: #211b15;
            --agri-surface-2: #2a231c;
            --agri-surface-3: #312920;
        
            --agri-text: #eee4d6;
            --agri-text-soft: #c9baa5;
            --agri-text-muted: #a99882;
        
            --agri-border: rgba(201, 178, 145, 0.14);
            --agri-border-strong: rgba(201, 178, 145, 0.22);
        
            --agri-accent: #6f7b49;
            --agri-accent-hover: #5f6a3d;
            --agri-accent-warm: #8a6a42;
        
            --agri-shadow: 0 16px 36px rgba(0, 0, 0, 0.30);
        }
        
        /* Sfondo generale */
        body {
            background:
                radial-gradient(circle at top, rgba(111, 123, 73, 0.06), transparent 28%),
                radial-gradient(circle at bottom, rgba(138, 106, 66, 0.05), transparent 24%),
                linear-gradient(180deg, var(--agri-bg) 0%, var(--agri-bg-2) 100%);
            color: var(--agri-text);
        }
        
        /* Header */
        header {
            background: linear-gradient(to bottom, #1a1510, #14100c, #110d0a);
            border-bottom: 1px solid var(--agri-border);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.42);
            transition: transform 0.28s ease, background 0.28s ease, box-shadow 0.28s ease;
            will-change: transform;
        }

        header.header-hidden {
        transform: translateY(-100%);
    }
        
        /* Footer */
        footer {
            background: transparent;
            border-top: 1px solid var(--agri-border);
        }
        
        /* Testi */
        .page-header h1,
        .page-section-title,
        .hero-heading,
        .hero-heading-center,
        .menu-category-title,
        .restaurant-feature-title,
        .home-feature-title,
        .restaurant-fact-value,
        .nav-main-link,
        .brand-text,
        .lang-select {
            color: var(--agri-text);
        }
        
        .muted,
        .hero-lead,
        .hero-lead-center,
        .restaurant-feature-body,
        .home-feature-text,
        .menu-dish-description,
        .menu-note,
        .restaurant-fact-label,
        .footer-meta,
        .footer-contact,
        .footer-link,
        .page-header .muted {
            color: var(--agri-text-soft);
            opacity: 1;
        }
        
        /* Card */
        .card,
        .page-where .card,
        .page-contacts .card {
            background: linear-gradient(
                180deg,
                rgba(33, 27, 21, 0.96) 0%,
                rgba(26, 21, 17, 0.96) 100%
            );
            border: 1px solid var(--agri-border);
            box-shadow: var(--agri-shadow);
        }
        
        .card:hover {
            border-color: var(--agri-border-strong);
            background: linear-gradient(
                180deg,
                rgba(40, 33, 26, 0.98) 0%,
                rgba(30, 24, 19, 0.98) 100%
            );
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.34);
        }
        
        /* Sezioni ristorante */
        .restaurant-feature {
            background: transparent;
        }
        
        .restaurant-feature-image {
            border-radius: 24px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.22);
        }
        
        /* Home */
        .home-info {
            background: linear-gradient(180deg, #17130f 0%, #1c1712 100%);
        }
        
        .home-info::before {
            opacity: 0.28;
        }
        
        /* Navbar */
        .nav-main-link.active {
            background: rgba(111, 123, 73, 0.14);
            border-color: rgba(111, 123, 73, 0.38);
        }
        
        .nav-main-link:hover {
            background: rgba(255, 255, 255, 0.03);
        }
        
        /* Select lingua */
        .lang-select {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--agri-border);
            color: var(--agri-text);
        }
        
        .lang-select option {
            background: #201a14;
            color: var(--agri-text);
        }
        
        /* Pulsante principale */
        .pill.primary {
            background: var(--agri-accent);
            color: #f7f2ea;
            border-color: transparent;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.18);
        }
        
        .pill.primary:hover {
            background: var(--agri-accent-hover);
        }
        
        /* Pulsanti secondari */
        .pill {
            border-color: var(--agri-border);
        }
        
        /* Form */
        .page-contacts input,
        .page-contacts textarea,
        .page-contacts select {
            background: #17130f;
            color: var(--agri-text);
            border: 1px solid var(--agri-border);
        }
        
        .page-contacts input:focus,
        .page-contacts textarea:focus,
        .page-contacts select:focus {
            outline: none;
            border-color: rgba(111, 123, 73, 0.42);
            box-shadow: 0 0 0 1px rgba(111, 123, 73, 0.20);
        }
        
        .page-contacts label {
            color: var(--agri-text);
        }
        
        /* Menu */
        .menu-dish-name,
        .menu-dish-price {
            color: var(--agri-text);
        }
        
        .menu-note {
            color: var(--agri-text-muted);
        }
        
        /* Facts */
        .restaurant-fact-label {
            color: var(--agri-text-muted);
        }
        
        .restaurant-fact-value {
            color: var(--agri-text);
        }
        
        /* Hero */
        .hero-home::after {
            background: linear-gradient(
                180deg,
                rgba(26, 18, 12, 0.16) 0%,
                rgba(26, 18, 12, 0.54) 100%
            );
        }
        
        .hero-bg-arrow span {
            color: rgba(255, 246, 234, 0.74);
        }
        
        /* Accent line */
        .home-feature-accent {
            background: linear-gradient(90deg, var(--agri-accent), var(--agri-accent-warm));
            box-shadow: 0 0 14px rgba(138, 106, 66, 0.16);
        }
    </style>
</head>
<body>
    {{-- HEADER + NAVBAR --}}
    <header>
        <div class="container">
            <nav>
                @php
                    $currentRoute = Route::currentRouteName();
                    $restaurantName = config('restaurant.name', 'Ristorante');
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
                $addressLine = config('restaurant.address_line');
                $phone = config('restaurant.phone');
                $email = config('restaurant.email');

                $locale = request()->route('locale') ?? config('locales.default', 'it');
                $logoPath = config('restaurant.logo');

                $instagramUrl = config('restaurant.instagram');
                $facebookUrl = config('restaurant.facebook');
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
                                <rect
                                    x="3"
                                    y="3"
                                    width="18"
                                    height="18"
                                    rx="5"
                                    ry="5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.6"
                                />
                                <circle
                                    cx="12"
                                    cy="12"
                                    r="4.3"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.6"
                                />
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
                                <path
                                    d="M13.5 21v-7h2.3l.4-3h-2.7V9.1c0-1.1.4-1.6 1.7-1.6H16V4.7
                                    C15.6 4.6 14.7 4.5 13.7 4.5c-2.7 0-4.4 1.6-4.4 4.6V11H7.5v3h1.8v7h4.2z"
                                    fill="currentColor"
                                />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>

            <div class="footer-right">
                <div class="footer-meta muted">
                    <span>© {{ date('Y') }} — {{ __('pages.footer_rights') }}</span>
                    <span class="footer-dot">•</span>
                    <a href="/{{ $locale }}/privacy" class="footer-link">
                        {{ __('pages.footer_privacy') }}
                    </a>
                </div>
            </div>
        </div>
    </footer>

    {{-- JS: HERO HOME + COLLASSO INTRO RISTORANTE --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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

                function goPrev() {
                    setActive(index - 1);
                }

                function goNext() {
                    setActive(index + 1);
                }

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

            (function () {
                var siteHeader = document.querySelector('header');
                if (!siteHeader) return;
            
                var lastScrollY = window.scrollY;
                var hideOffset = 90;
            
                window.addEventListener('scroll', function () {
                    if (window.innerWidth <= 640) return;
            
                    var currentScrollY = window.scrollY;
            
                    if (currentScrollY <= 0) {
                        siteHeader.classList.remove('header-hidden');
                        lastScrollY = currentScrollY;
                        return;
                    }
            
                    if (currentScrollY > lastScrollY && currentScrollY > hideOffset) {
                        siteHeader.classList.add('header-hidden');
                    } else {
                        siteHeader.classList.remove('header-hidden');
                    }
            
                    lastScrollY = currentScrollY;
                }, { passive: true });
            })();

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