<x-layouts.app
    :title="__('seo.where.title')"
    :meta-description="__('seo.where.description')"
>
    @php
        $restaurantName = config('restaurant.name', 'Ristorante');
        $addressLine    = config('restaurant.address_line');
        $phone          = config('restaurant.phone');
        $email          = config('restaurant.email');

        $mapsQuery = urlencode(config('restaurant.maps_query', 'Torre di Blaga, Italia'));
        $mapsUrl   = "https://www.google.com/maps/search/?api=1&query={$mapsQuery}";
        $locale    = request()->route('locale') ?? config('locales.default', 'it');
    @endphp

    <div class="container page">
        <div class="page-header">
            <h1>{{ __('pages.where.title') }}</h1>
            <p class="muted">
                {{ __('pages.where.text') }}
            </p>
        </div>

        <div class="grid">
            <div class="card">
                <h2 style="margin-top:0; font-size:20px;">
                    {{ $restaurantName }}
                </h2>

                <p class="muted" style="margin-bottom:16px;">
                    @if($addressLine)
                        {{ $addressLine }}<br>
                    @endif

                    @if($phone)
                        Tel: <a href="tel:{{ $phone }}">{{ $phone }}</a><br>
                    @endif

                    @if($email)
                        Email: <a href="mailto:{{ $email }}">{{ $email }}</a>
                    @endif
                </p>

                <div style="display:flex; gap:12px; flex-wrap:wrap; margin-top:8px;">
                    <a class="pill primary" href="{{ $mapsUrl }}" target="_blank" rel="noopener">
                        {{ __('pages.where.cta_maps') }}
                    </a>

                    {{--<a class="pill" href="/{{ $locale }}/contatti">
                        {{ __('pages.nav.contacts') }}
                    </a>
                </div>
            </div>

            <div class="card">
                <h2 style="margin-top:0; font-size:20px;">
                    {{ __('pages.contacts.title') }}
                </h2>
                <p class="muted">
                    {{ __('pages.contacts.intro') }}
                </p>--}}
            </div>
        </div>
    </div>
</x-layouts.app>
