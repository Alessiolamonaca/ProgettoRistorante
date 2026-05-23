<x-layouts.app
    :title="__('seo.home.title')"
    :meta-description="__('seo.home.description')"
>
    @php
        $locale = request()->route('locale') ?? config('locales.default', 'it');

        $homeStats = trans('luxury.home.strip');
        $homeStats = is_array($homeStats) ? $homeStats : [];

        $introPoints = trans('luxury.home.intro_points');
        $introPoints = is_array($introPoints) ? $introPoints : [];

        $experiences = trans('luxury.home.experiences');
        $experiences = is_array($experiences) ? $experiences : [];

        $flowSteps = trans('luxury.home.flow_steps');
        $flowSteps = is_array($flowSteps) ? $flowSteps : [];

        $homeFeatures = [
            [
                'eyebrow' => __('pages.home.info_kicker'),
                'title' => __('pages.home.info_title'),
                'text' => __('pages.home.info_text'),
                'detail' => __('pages.home.info_detail'),
                'action_label' => __('pages.home.cta_menu'),
                'action_url' => route('menu', ['locale' => $locale]),
                'images' => [
                    asset('images/pallotte cace e ovo.jpg'),
                    asset('images/sagne e ceci.jpg'),
                    asset('images/tagliatelle al  pomodoro.jpg'),
                ],
            ],
            [
                'eyebrow' => __('pages.home.style_kicker'),
                'title' => __('pages.home.style_title'),
                'text' => __('pages.home.style_text'),
                'detail' => __('pages.home.style_detail'),
                'action_label' => __('pages.nav.restaurant'),
                'action_url' => route('ristorante', ['locale' => $locale]),
                'images' => [
                    asset('images/arrosticini.jpg'),
                    asset('images/carne alla brace.jpg'),
                    asset('images/carne alla brace 2.jpg'),
                ],
            ],
            [
                'eyebrow' => __('pages.home.book_kicker'),
                'title' => __('pages.home.book_title'),
                'text' => __('pages.home.book_text'),
                'detail' => __('pages.home.book_detail'),
                'action_label' => __('pages.nav.book'),
                'action_url' => route('contatti', ['locale' => $locale]),
                'images' => [
                    asset('images/pizza3.jpg'),
                    asset('images/pizza.jpg'),
                    asset('images/pizza 2.jpg'),
                ],
            ],
        ];
    @endphp

    <section class="hero hero-home" data-hero-bg>
        <div class="hero-bg-track">
            <div
                class="hero-bg-slide is-active"
                style="background-image: url('{{ asset('images/sala interna.jpg') }}');"
            ></div>

            <div
                class="hero-bg-slide"
                style="background-image: url('{{ asset('images/piatto-1.jpg') }}');"
            ></div>

            <div
                class="hero-bg-slide"
                style="background-image: url('{{ asset('images/braceria-2.jpg') }}');"
            ></div>
        </div>

        <div class="hero-content-center">
            <div class="container">
                <p class="hero-kicker">
                    {{ __('luxury.home.hero_kicker') }}
                </p>

                <h1 class="hero-heading hero-heading-center">
                    {{ __('pages.home.title') }}
                </h1>

                <p class="hero-lead hero-lead-center">
                    {{ __('luxury.home.hero_subtitle') }}
                </p>

                <div class="hero-actions hero-actions-center">
                    <a class="pill primary" href="{{ route('contatti', ['locale' => $locale]) }}">
                        {{ __('luxury.home.hero_primary') }}
                    </a>

                    <a class="pill" href="{{ route('menu', ['locale' => $locale]) }}">
                        {{ __('luxury.home.hero_secondary') }}
                    </a>
                </div>
            </div>
        </div>

        <button
            type="button"
            class="hero-bg-arrow hero-bg-arrow-left"
            data-hero-bg-prev
            aria-label="{{ __('pages.home.prev_image') }}"
        >
            <span>&lsaquo;</span>
        </button>

        <button
            type="button"
            class="hero-bg-arrow hero-bg-arrow-right"
            data-hero-bg-next
            aria-label="{{ __('pages.home.next_image') }}"
        >
            <span>&rsaquo;</span>
        </button>
    </section>

    @if ($homeStats !== [])
        <section class="home-reservation-strip" aria-label="{{ __('luxury.home.strip_label') }}">
            <div class="container reservation-strip-inner">
                @foreach ($homeStats as $item)
                    <article class="reservation-strip-item">
                        <strong>{{ $item['value'] ?? '' }}</strong>
                        <span>{{ $item['label'] ?? '' }}</span>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <section class="home-editorial">
        <div class="container home-editorial-grid">
            <div class="section-header section-header-left">
                <p class="section-kicker">{{ __('luxury.home.intro_kicker') }}</p>
                <h2 class="section-title">{{ __('luxury.home.intro_title') }}</h2>
            </div>

            <div class="home-editorial-copy">
                <p>{{ __('luxury.home.intro_text') }}</p>

                @if ($introPoints !== [])
                    <ul class="clean-list">
                        @foreach ($introPoints as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </section>

    <section class="home-info">
        <div class="container">
            <div class="home-info-grid">
                @foreach ($homeFeatures as $feature)
                    <article class="home-feature {{ $loop->even ? 'home-feature-reverse' : '' }}">
                        <div class="home-feature-inner">
                            <div class="home-feature-copy">
                                <span class="home-feature-accent" aria-hidden="true"></span>

                                <p class="home-feature-kicker">
                                    {{ $feature['eyebrow'] }}
                                </p>

                                <h3 class="home-feature-title">
                                    {{ $feature['title'] }}
                                </h3>

                                <p class="home-feature-text">
                                    {{ $feature['text'] }}
                                </p>

                                <p class="home-feature-detail">
                                    {{ $feature['detail'] }}
                                </p>

                                <a href="{{ $feature['action_url'] }}" class="pill home-feature-action">
                                    {{ $feature['action_label'] }}
                                </a>
                            </div>

                            <div class="home-feature-gallery">
                                <div class="home-feature-shot-stack">
                                    @foreach ($feature['images'] as $image)
                                        <figure class="home-feature-shot {{ $loop->first ? 'home-feature-shot-main' : 'home-feature-shot-secondary' }}">
                                            <img
                                                src="{{ $image }}"
                                                alt="{{ $feature['title'] }}"
                                                loading="lazy"
                                            >
                                        </figure>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    @if ($experiences !== [])
        <section class="home-experiences">
            <div class="container">
                <div class="section-header">
                    <p class="section-kicker">{{ __('luxury.home.experiences_kicker') }}</p>
                    <h2 class="section-title">{{ __('luxury.home.experiences_title') }}</h2>
                    <p class="section-lead">{{ __('luxury.home.experiences_text') }}</p>
                </div>

                <div class="premium-grid">
                    @foreach ($experiences as $experience)
                        <article class="premium-card">
                            <span class="premium-card-meta">{{ $experience['meta'] ?? '' }}</span>
                            <h3>{{ $experience['title'] ?? '' }}</h3>
                            <p>{{ $experience['text'] ?? '' }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="home-gallery-band" aria-label="{{ __('luxury.restaurant.gallery_title') }}">
        <div class="container image-mosaic">
            <figure class="mosaic-image mosaic-image-large">
                <img src="{{ asset('images/sala interna2.jpg') }}" alt="Sala RISTORANTE" loading="lazy">
            </figure>
            <figure class="mosaic-image">
                <img src="{{ asset('images/piatto-2.jpg') }}" alt="Piatto RISTORANTE" loading="lazy">
            </figure>
            <figure class="mosaic-image">
                <img src="{{ asset('images/carne alla brace.jpg') }}" alt="Brace RISTORANTE" loading="lazy">
            </figure>
            <figure class="mosaic-image mosaic-image-wide">
                <img src="{{ asset('images/piatto-4.jpg') }}" alt="Tavola RISTORANTE" loading="lazy">
            </figure>
        </div>
    </section>

    @if ($flowSteps !== [])
        <section class="home-service-flow">
            <div class="container">
                <div class="section-header">
                    <p class="section-kicker">{{ __('luxury.home.flow_kicker') }}</p>
                    <h2 class="section-title">{{ __('luxury.home.flow_title') }}</h2>
                </div>

                <div class="flow-steps">
                    @foreach ($flowSteps as $step)
                        <article class="flow-step">
                            <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <h3>{{ $step['label'] ?? '' }}</h3>
                            <p>{{ $step['text'] ?? '' }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>