<x-layouts.app
    :title="__('seo.restaurant.title')"
    :meta-description="__('seo.restaurant.description')"
>
    <section class="page page-restaurant">
        <div class="container">
            {{-- Header pagina --}}
            <header class="page-header">
                <p class="page-section-title">
                    {{ __('pages.restaurant.title') }}
                </p>

                <h1>
                    {{ __('pages.restaurant.hero_title') }}
                </h1>

                <p class="muted">
                    {{ __('pages.restaurant.intro') }}
                </p>
            </header>

            {{-- Sezioni descrittive --}}
            <section class="restaurant-sections">
                {{-- Sezione 1: La sala --}}
                <article class="restaurant-feature">
                    <div class="restaurant-feature-text">
                        <h2 class="restaurant-feature-title">
                            {{ __('pages.restaurant.room_title') }}
                        </h2>
                        <p class="restaurant-feature-body">
                            {{ __('pages.restaurant.room_text') }}
                        </p>
                    </div>

                    <div class="restaurant-feature-image">
                        <img
                            src="{{ asset('images/ristorante-sala.jpg') }}"
                            alt="{{ __('pages.restaurant.room_title') }} Torre di Blaga"
                        >
                    </div>
                </article>

                {{-- Sezione 2: La brace e la cucina --}}
                <article class="restaurant-feature restaurant-feature-alt">
                    <div class="restaurant-feature-text">
                        <h2 class="restaurant-feature-title">
                            {{ __('pages.restaurant.kitchen_title') }}
                        </h2>
                        <p class="restaurant-feature-body">
                            {{ __('pages.restaurant.kitchen_text') }}
                        </p>
                    </div>

                    <div class="restaurant-feature-image">
                        <img
                            src="{{ asset('images/ristorante-brace.jpg') }}"
                            alt="{{ __('pages.restaurant.kitchen_title') }} Torre di Blaga"
                        >
                    </div>
                </article>

                {{-- Sezione 3: L’agriturismo e la campagna --}}
                <article class="restaurant-feature">
                    <div class="restaurant-feature-text">
                        <h2 class="restaurant-feature-title">
                            {{ __('pages.restaurant.territory_title') }}
                        </h2>
                        <p class="restaurant-feature-body">
                            {{ __('pages.restaurant.territory_text') }}
                        </p>
                    </div>

                    <div class="restaurant-feature-image">
                        <img
                            src="{{ asset('images/ristorante-esterno-2.jpg') }}"
                            alt="{{ __('pages.restaurant.territory_title') }} Torre di Blaga"
                        >
                    </div>
                </article>
            </section>

            {{-- Dati riassuntivi --}}
            <section class="restaurant-facts">
                <div class="restaurant-fact">
                    <span class="restaurant-fact-label">
                        {{ __('pages.restaurant.facts_specialties_label') }}
                    </span>
                    <span class="restaurant-fact-value">
                        {{ __('pages.restaurant.facts_specialties_value') }}
                    </span>
                </div>

                <div class="restaurant-fact">
                    <span class="restaurant-fact-label">
                        {{ __('pages.restaurant.facts_seasonality_label') }}
                    </span>
                    <span class="restaurant-fact-value">
                        {{ __('pages.restaurant.facts_seasonality_value') }}
                    </span>
                </div>
            </section>
        </div>
    </section>
</x-layouts.app>
