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
        $phoneHref = $phone ? 'tel:' . preg_replace('/\D+/', '', $phone) : null;
    @endphp

    <section class="page page-where">
        <div class="container">
            <header class="page-header">
                <h1>{{ __('pages.where.title') }}</h1>
                <p class="muted">
                    {{ __('pages.where.text') }}
                </p>
            </header>

            <section class="grid">
                <article class="card">
                    <h2 style="margin-top: 0; font-size: 20px;">
                        {{ $restaurantName }}
                    </h2>

                    <p class="muted" style="margin-bottom: 16px;">
                        @if ($addressLine)
                            {{ $addressLine }}<br>
                        @endif

                        @if ($phone)
                            <strong>Tel:</strong>
                            <a href="{{ $phoneHref ?? '#' }}">{{ $phone }}</a><br>
                        @endif

                        @if ($email)
                            <strong>Email:</strong>
                            <a href="mailto:{{ $email }}">{{ $email }}</a>
                        @endif
                    </p>

                    <div class="hero-actions">
                        <a
                            class="pill primary"
                            href="{{ $mapsUrl }}"
                            target="_blank"
                            rel="noopener"
                        >
                            {{ __('pages.where.cta_maps') }}
                        </a>

                        <a class="pill" href="/{{ $locale }}/contatti">
                            {{ __('pages.nav.contacts') }}
                        </a>
                    </div>
                </article>
            </section>
        </div>
    </section>
</x-layouts.app>