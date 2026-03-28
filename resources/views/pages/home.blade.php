<x-layouts.app
    :title="__('seo.home.title')"
    :meta-description="__('seo.home.description')"
>
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

    {{-- SEZIONE INFORMATIVA: 3 blocchi fotografici --}}
    <section class="home-info">
        <div class="container">
            <div class="home-info-grid">
                <article class="home-feature">
                    <div class="home-feature-inner">
                        <div class="home-feature-copy">
                            <span class="home-feature-accent" aria-hidden="true"></span>

                            <h3 class="home-feature-title">
                                {{ __('pages.home.info_title') }}
                            </h3>

                            <p class="home-feature-text">
                                {{ __('pages.home.info_text') }}
                            </p>
                        </div>

                        <div class="home-feature-gallery" aria-hidden="true">
                            <figure class="home-feature-shot home-feature-shot-main">
                                <img src="{{ asset('images/pallotte cace e ovo.jpg') }}" alt="" loading="lazy">
                            </figure>
                        </div>
                    </div>
                </article>

                <article class="home-feature home-feature-reverse">
                    <div class="home-feature-inner">
                        <div class="home-feature-copy">
                            <span class="home-feature-accent" aria-hidden="true"></span>

                            <h3 class="home-feature-title">
                                {{ __('pages.home.style_title') }}
                            </h3>

                            <p class="home-feature-text">
                                {{ __('pages.home.style_text') }}
                            </p>
                        </div>

                        <div class="home-feature-gallery" aria-hidden="true">
                            <figure class="home-feature-shot home-feature-shot-main">
                                <img src="{{ asset('images/arrosticini.jpg') }}" alt="" loading="lazy">
                            </figure>
                        </div>
                    </div>
                </article>

                <article class="home-feature">
                    <div class="home-feature-inner">
                        <div class="home-feature-copy">
                            <span class="home-feature-accent" aria-hidden="true"></span>

                            <h3 class="home-feature-title">
                                {{ __('pages.home.book_title') }}
                            </h3>

                            <p class="home-feature-text">
                                {{ __('pages.home.book_text') }}
                            </p>
                        </div>

                        <div class="home-feature-gallery" aria-hidden="true">
                            <figure class="home-feature-shot home-feature-shot-main">
                                <img src="{{ asset('images/pizza3.jpg') }}" alt="" loading="lazy">
                            </figure>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
</x-layouts.app>