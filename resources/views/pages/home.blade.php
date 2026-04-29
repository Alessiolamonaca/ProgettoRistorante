<x-layouts.app
    :title="__('seo.home.title')"
    :meta-description="__('seo.home.description')"
>
    @php
        $locale = request()->route('locale') ?? config('locales.default', 'it');
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
                style="background-image: url('{{ asset('images/ristorante-esterno.jpg') }}');"
            ></div>

            <div
                class="hero-bg-slide"
                style="background-image: url('{{ asset('images/sala.jpg') }}');"
            ></div>

            <div
                class="hero-bg-slide"
                style="background-image: url('{{ asset('images/braceria-2.jpg') }}');"
            ></div>
        </div>

        <div class="hero-content-center">
            <div class="container">
                <h1 class="hero-heading hero-heading-center">
                    {{ __('pages.home.title') }}
                </h1>

                <p class="hero-lead hero-lead-center">
                    {{ __('pages.home.subtitle') }}
                </p>
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
</x-layouts.app>
