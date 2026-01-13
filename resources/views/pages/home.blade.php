<x-layouts.app
    :title="__('seo.home.title')"
    :meta-description="__('seo.home.description')"
>
    <section class="hero">
        <div class="container grid">
            <div>
                <h1 class="hero-heading">
                    {{ __('pages.home.title') }}
                </h1>

                <p class="muted hero-lead">
                    {{ __('pages.home.subtitle') }}
                </p>

                <div class="hero-actions">
                    <a class="pill primary"
                       href="{{ route('menu', ['locale' => request()->route('locale')]) }}">
                        {{ __('pages.home.cta_menu') }}
                    </a>

                    <a class="pill"
                       href="{{ route('dove-siamo', ['locale' => request()->route('locale')]) }}">
                        {{ __('pages.home.cta_where') }}
                    </a>
                </div>
            </div>

            <div class="card">
                {{-- HERO con slider automatico --}}
                <div
                    class="hero-image"
                    id="hero-slider"
                    data-images='["/images/hero-sala.jpg","/images/piatto-1.jpg","/images/piatto-2.jpg"]'
                    style="background-image: url('/images/hero-sala.jpg');"
                ></div>

                {{-- Piccola galleria statica sotto --}}
                <div class="gallery">
                    <img src="/images/piatto-1.jpg" alt="Piatto 1">
                    <img src="/images/piatto-2.jpg" alt="Piatto 2">
                    <img src="/images/esterno-1.jpg" alt="Esterno">
                </div>
            </div>
        </div>
    </section>

    <div class="container" style="padding-top: 24px;">
        <div class="grid">
            <div class="card">
                <h3 style="margin-top:0;">{{ __('pages.home.info_title') }}</h3>
                <p class="muted">
                    {{ __('pages.home.info_text') }}
                </p>
            </div>
            <div class="card">
                <h3 style="margin-top:0;">{{ __('pages.home.style_title') }}</h3>
                <p class="muted">
                    {{ __('pages.home.style_text') }}
                </p>
            </div>
            <div class="card">
                <h3 style="margin-top:0;">{{ __('pages.home.book_title') }}</h3>
                <p class="muted">
                    {{ __('pages.home.book_text') }}
                </p>
            </div>
        </div>
    </div>
</x-layouts.app>
