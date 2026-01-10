<x-layouts.app
    :title="__('seo.not_found.title')"
    :meta-description="__('seo.not_found.description')"
>
    <div class="container" style="padding-top: 24px;">
        <div class="card">
            <h1 style="margin-top:0;">
                {{ __('pages.not_found.title') }}
            </h1>
            <p class="muted">
                {{ __('pages.not_found.text') }}
            </p>

            @php
                $locale = request()->route('locale') ?? config('locales.default', 'it');
            @endphp

            <div style="margin-top:16px;">
                <a class="pill primary" href="/{{ $locale }}">
                    {{ __('pages.not_found.back_home') }}
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
