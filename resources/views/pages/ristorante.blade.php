<x-layouts.app
    :title="__('seo.restaurant.title')"
    :meta-description="__('seo.restaurant.description')"
>
    @php
        $restaurantHighlights = trans('luxury.restaurant.highlights');
        $restaurantHighlights = is_array($restaurantHighlights) ? $restaurantHighlights : [];

        $restaurantRituals = trans('luxury.restaurant.rituals');
        $restaurantRituals = is_array($restaurantRituals) ? $restaurantRituals : [];

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
                    {{ __('luxury.restaurant.hero_intro') }}
                </p>
            </header>

            @if ($restaurantHighlights !== [])
                <section class="restaurant-highlight-section" aria-labelledby="restaurant-highlights-title">
                    <div class="section-header">
                        <p class="section-kicker">{{ __('luxury.restaurant.highlights_kicker') }}</p>
                        <h2 id="restaurant-highlights-title" class="section-title">{{ __('luxury.restaurant.highlights_title') }}</h2>
                    </div>

                    <div class="restaurant-highlight-grid">
                        @foreach ($restaurantHighlights as $highlight)
                            <article class="restaurant-highlight">
                                <span>{{ $highlight['label'] ?? '' }}</span>
                                <h3>{{ $highlight['title'] ?? '' }}</h3>
                                <p>{{ $highlight['text'] ?? '' }}</p>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

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
                                alt="{{ $feature['title'] }} RISTORANTE"
                                loading="lazy"
                            >
                        </div>
                    </article>
                @endforeach
            </section>

            <section class="restaurant-gallery-band" aria-labelledby="restaurant-gallery-title">
                <div class="section-header section-header-left">
                    <p class="section-kicker">{{ __('luxury.restaurant.gallery_kicker') }}</p>
                    <h2 id="restaurant-gallery-title" class="section-title">{{ __('luxury.restaurant.gallery_title') }}</h2>
                    <p class="section-lead">{{ __('luxury.restaurant.gallery_text') }}</p>
                </div>

                <div class="image-mosaic restaurant-image-mosaic">
                    <figure class="mosaic-image mosaic-image-large">
                        <img src="{{ asset('images/sala interna2.jpg') }}" alt="Sala elegante RISTORANTE" loading="lazy">
                    </figure>
                    <figure class="mosaic-image">
                        <img src="{{ asset('images/piatto-3.jpg') }}" alt="Piatto stagionale RISTORANTE" loading="lazy">
                    </figure>
                    <figure class="mosaic-image">
                        <img src="{{ asset('images/arrosticini2.jpg') }}" alt="Arrosticini RISTORANTE" loading="lazy">
                    </figure>
                    <figure class="mosaic-image mosaic-image-wide">
                        <img src="{{ asset('images/carne alla brace 2.jpg') }}" alt="Carne alla brace RISTORANTE" loading="lazy">
                    </figure>
                </div>
            </section>

            @if ($restaurantRituals !== [])
                <section class="restaurant-rituals" aria-labelledby="restaurant-rituals-title">
                    <div class="section-header">
                        <p class="section-kicker">{{ __('luxury.restaurant.rituals_kicker') }}</p>
                        <h2 id="restaurant-rituals-title" class="section-title">{{ __('luxury.restaurant.rituals_title') }}</h2>
                    </div>

                    <div class="flow-steps flow-steps-three">
                        @foreach ($restaurantRituals as $ritual)
                            <article class="flow-step">
                                <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <h3>{{ $ritual['title'] ?? '' }}</h3>
                                <p>{{ $ritual['text'] ?? '' }}</p>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

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