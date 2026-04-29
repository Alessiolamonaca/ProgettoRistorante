<x-layouts.app
    :title="__('seo.restaurant.title')"
    :meta-description="__('seo.restaurant.description')"
>
    @php
        $restaurantFeatures = [
            [
                'eyebrow' => __('pages.restaurant.room_kicker'),
                'title' => __('pages.restaurant.room_title'),
                'text' => __('pages.restaurant.room_text'),
                'detail' => __('pages.restaurant.room_detail'),
                'image' => asset('images/sala interna.jpg'),
            ],
            [
                'eyebrow' => __('pages.restaurant.kitchen_kicker'),
                'title' => __('pages.restaurant.kitchen_title'),
                'text' => __('pages.restaurant.kitchen_text'),
                'detail' => __('pages.restaurant.kitchen_detail'),
                'image' => asset('images/cucina.jpg'),
            ],
            [
                'eyebrow' => __('pages.restaurant.territory_kicker'),
                'title' => __('pages.restaurant.territory_title'),
                'text' => __('pages.restaurant.territory_text'),
                'detail' => __('pages.restaurant.territory_detail'),
                'image' => asset('images/esterno3.jpg'),
            ],
        ];

        $restaurantFacts = [
            [
                'label' => __('pages.restaurant.facts_specialties_label'),
                'value' => __('pages.restaurant.facts_specialties_value'),
                'text' => __('pages.restaurant.facts_specialties_text'),
            ],
            [
                'label' => __('pages.restaurant.facts_seasonality_label'),
                'value' => __('pages.restaurant.facts_seasonality_value'),
                'text' => __('pages.restaurant.facts_seasonality_text'),
            ],
            [
                'label' => __('pages.restaurant.facts_hospitality_label'),
                'value' => __('pages.restaurant.facts_hospitality_value'),
                'text' => __('pages.restaurant.facts_hospitality_text'),
            ],
        ];
    @endphp

    <section class="page page-restaurant">
        <div class="container">
            <header class="page-header" data-collapse-on-scroll>
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

            <section class="restaurant-sections">
                @foreach ($restaurantFeatures as $feature)
                    <article class="restaurant-feature {{ $loop->even ? 'restaurant-feature-alt' : '' }}">
                        <div class="restaurant-feature-text">
                            <p class="restaurant-feature-kicker">
                                {{ $feature['eyebrow'] }}
                            </p>

                            <h2 class="restaurant-feature-title">
                                {{ $feature['title'] }}
                            </h2>

                            <p class="restaurant-feature-body">
                                {{ $feature['text'] }}
                            </p>

                            <p class="restaurant-feature-detail">
                                {{ $feature['detail'] }}
                            </p>
                        </div>

                        <div class="restaurant-feature-image">
                            <img
                                src="{{ $feature['image'] }}"
                                alt="{{ $feature['title'] }} Torre di Blaga"
                                loading="lazy"
                            >
                        </div>
                    </article>
                @endforeach
            </section>

            <section class="restaurant-facts">
                @foreach ($restaurantFacts as $fact)
                    <article class="restaurant-fact">
                        <span class="restaurant-fact-label">
                            {{ $fact['label'] }}
                        </span>
                        <span class="restaurant-fact-value">
                            {{ $fact['value'] }}
                        </span>
                        <p class="restaurant-fact-text">
                            {{ $fact['text'] }}
                        </p>
                    </article>
                @endforeach
            </section>
        </div>
    </section>
</x-layouts.app>
