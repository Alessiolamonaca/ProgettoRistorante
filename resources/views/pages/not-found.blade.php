<x-layouts.app
    :title="__('pages.not_found.title')"
    :meta-description="__('pages.not_found.text')"
>
    <section class="page">
        <div class="container">
            <header class="page-header">
                <h1>{{ __('pages.not_found.title') }}</h1>
                <p class="muted">
                    {{ __('pages.not_found.text') }}
                </p>
            </header>

            @php
                $locale = request()->route('locale')
                    ?? config('locales.default', 'it');
            @endphp

            <div>
                <a href="/{{ $locale }}" class="pill primary">
                    {{ __('pages.not_found.back_home') }}
                </a>
            </div>
        </div>
    </section>
</x-layouts.app>
