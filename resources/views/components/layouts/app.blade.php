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
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.03);
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                border-color 0.2s ease,
                background 0.2s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            border-color: rgba(255, 255, 255, 0.16);
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
            display: grid;
            grid-template-rows: 1fr 1fr;
            gap: 1.25rem;
        }
        
        .home-feature-gallery::before {
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            left: -24px;
            width: 110px;
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
            display: grid;
            grid-template-rows: 1fr 1fr;
            gap: 1.25rem;
        }
        
        .home-feature-shot {
            position: relative;
            min-height: 170px;
            overflow: hidden;
            border-radius: 24px;
            background: transparent;
            box-shadow: none;
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
            gap: 1.2rem;
            min-height: auto;
        }
    
        .home-feature-copy {
            max-width: 100%;
        }
    
        .home-feature-gallery {
            grid-template-columns: minmax(0, 1.18fr) minmax(140px, 0.82fr);
            min-height: auto;
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
            min-height: 420px;
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
            margin-top: 24px;
            font-size: 13px;
        }

        /* =========================
        PAGINA RISTORANTE
        ========================= */
        .restaurant-sections {
            display: flex;
            flex-direction: column;
            gap: 24px;
            margin-top: 16px;
        }

        .restaurant-feature {
            position: relative;
            display: grid;
            align-items: center;
            gap: 16px;
            padding: 18px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 24px;
            background: radial-gradient(
                900px 600px at 0% 0%,
                rgba(255, 255, 255, 0.08),
                rgba(255, 255, 255, 0.02)
            );
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.75);
        }

        .restaurant-feature::before {
            content: "";
            position: absolute;
            inset: 0;
            border: 1px dashed rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            pointer-events: none;
        }

        .restaurant-feature-text {
            position: relative;
            z-index: 1;
        }

        .restaurant-feature-title {
            margin: 0 0 6px;
            font-size: 20px;
            letter-spacing: 0.03em;
        }

        .restaurant-feature-body {
            margin: 0;
            font-size: 15px;
            line-height: 1.7;
            opacity: 0.92;
        }

        .restaurant-feature-image {
            position: relative;
            min-height: 200px;
            overflow: hidden;
            border-radius: 18px;
        }

        .restaurant-feature-image img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scale(1.02);
            transition: transform 0.25s ease;
        }

        .restaurant-feature:hover .restaurant-feature-image img {
            transform: scale(1.06);
        }

        .restaurant-facts {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: center;
            gap: 40px;
            max-width: 100%;
            margin: 24px auto 0;
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
                    <span>© {{ date('Y') }} — Tutti i diritti riservati</span>
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