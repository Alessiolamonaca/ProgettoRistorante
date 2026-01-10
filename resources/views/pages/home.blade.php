<x-layouts.app
    :title="__('seo.home.title')"
    :meta-description="__('seo.home.description')"
>
    <section class="hero">
        <div class="container grid">
            <div>
                <h1 style="margin:0 0 12px; font-size: 40px; line-height: 1.1;">
                    {{ __('pages.home.title') }}
                </h1>
                <p class="muted" style="margin:0 0 18px;">
                    {{ __('pages.home.subtitle') }}
                </p>
                <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    {{--<a class="pill primary" href="/{{ request()->route('locale') }}/menu">
                        {{ __('pages.home.cta_menu') }}
                    </a>
                    <a class="pill" href="/{{ request()->route('locale') }}/dove-siamo">
                        {{ __('pages.home.cta_where') }}
                    </a>--}}
                </div>
            </div>

            <div class="card">
                <div class="hero-image" style="background-image: url('/images/hero-sala.jpg');"></div>
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
