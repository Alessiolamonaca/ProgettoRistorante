<x-layouts.app
    :title="__('seo.privacy.title')"
    :meta-description="__('seo.privacy.description')"
>
    <div class="container" style="padding-top: 24px;">
        <div class="card" style="margin-bottom: 20px;">
            <h1 style="margin-top:0;">{{ __('pages.privacy.title') }}</h1>
            <p class="muted">
                {{ __('pages.privacy.intro') }}
            </p>
        </div>

        <div class="grid">
            <div class="card">
                <h2 style="margin-top:0; font-size:20px;">
                    {{ __('pages.privacy.data_title') }}
                </h2>
                <p class="muted">
                    {{ __('pages.privacy.data_text') }}
                </p>
            </div>

            <div class="card">
                <h2 style="margin-top:0; font-size:20px;">
                    {{ __('pages.privacy.cookies_title') }}
                </h2>
                <p class="muted">
                    {{ __('pages.privacy.cookies_text') }}
                </p>
            </div>
        </div>

        <div class="card" style="margin-top: 20px;">
            <h2 style="margin-top:0; font-size:20px;">
                {{ __('pages.privacy.contacts_title') }}
            </h2>
            <p class="muted">
                {{ __('pages.privacy.contacts_text') }}
            </p>
        </div>
    </div>
</x-layouts.app>
