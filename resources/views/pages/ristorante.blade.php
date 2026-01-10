<x-layouts.app
    :title="__('seo.restaurant.title')"
    :meta-description="__('seo.restaurant.description')"
>
    <div class="container" style="padding-top: 24px">
        <div class="card" style="margin-bottom: 24px">
            <h1 style="margin-top: 0">{{ __('pages.restaurant.title') }}</h1>
            <p class="muted">
                {{ __('pages.restaurant.intro') }}
            </p>
        </div>
        <div class="grid">
            <div class="card">
                <h2 style="margin-top:0 fonti-size:20px">{{ __('pages.restaurant.title') }}</h2>
                <p class="muted">
                    {{ __('pages.restaurant.history_text') }}
                </p>
            </div>
        </div>
        <div class="grid" style="margin-top:16px;">
            <div class="card">
                <h2 style="margin-top:0; font-size:20px;">{{ __('pages.restaurant.room_title') }}</h2>
                <p class="muted">
                    {{ __('pages.restaurant.room_text') }}
                </p>
            </div>

            <div class="card">
                <h2 style="margin-top:0; font-size:20px;">{{ __('pages.restaurant.territory_title') }}</h2>
                <p class="muted">
                    {{ __('pages.restaurant.territory_text') }}
                </p>
            </div>
        </div>
    </div>
</x-layouts.app>
