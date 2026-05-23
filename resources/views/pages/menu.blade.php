<x-layouts.app
    :title="__('seo.menu.title')"
    :meta-description="__('seo.menu.description')"
>
    @php
        /** @var \Illuminate\Support\Collection|\App\Models\Category[] $categories */
        $menuJourneys = trans('luxury.menu.journeys');
        $menuJourneys = is_array($menuJourneys) ? $menuJourneys : [];

        $pairings = trans('luxury.menu.pairings');
        $pairings = is_array($pairings) ? $pairings : [];
    @endphp

    <section class="page page-menu">
        <div class="container">
            <header class="page-header">
                <p class="page-section-title">{{ __('luxury.menu.journey_kicker') }}</p>
                <h1>{{ __('pages.menu_page.title') }}</h1>
                <p class="muted">
                    {{ __('luxury.menu.intro') }}
                </p>
            </header>

            @if ($menuJourneys !== [])
                <section class="menu-journeys" aria-labelledby="menu-journeys-title">
                    <div class="section-header">
                        <p class="section-kicker">{{ __('luxury.menu.journey_kicker') }}</p>
                        <h2 id="menu-journeys-title" class="section-title">{{ __('luxury.menu.journey_title') }}</h2>
                        <p class="section-lead">{{ __('luxury.menu.journey_text') }}</p>
                    </div>

                    <div class="menu-journey-grid">
                        @foreach ($menuJourneys as $journey)
                            <article class="menu-journey">
                                <div class="menu-journey-header">
                                    <span>{{ $journey['tag'] ?? '' }}</span>
                                    <h3>{{ $journey['name'] ?? '' }}</h3>
                                </div>

                                <p>{{ $journey['summary'] ?? '' }}</p>

                                @if (! empty($journey['details']) && is_array($journey['details']))
                                    <ul class="clean-list clean-list-compact">
                                        @foreach ($journey['details'] as $detail)
                                            <li>{{ $detail }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

            <section class="grid menu-category-grid" aria-label="{{ __('pages.menu_page.title') }}">
                @forelse ($categories as $category)
                    <article class="card menu-category-card">
                        <h2 class="menu-category-title">
                            {{ $category->name }}
                        </h2>

                        <div class="menu-dishes">
                            @foreach ($category->dishes as $dish)
                                <div class="menu-dish-row">
                                    <div class="menu-dish-text">
                                        <p class="menu-dish-name">
                                            {{ $dish->name }}
                                        </p>

                                        @if ($dish->description)
                                            <p class="menu-dish-description muted">
                                                {{ $dish->description }}
                                            </p>
                                        @endif
                                    </div>

                                    @if ($dish->formatted_price)
                                        <div class="menu-dish-price">
                                            {{ $dish->formatted_price }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </article>
                @empty
                    <article class="card menu-category-card">
                        <p class="menu-note">{{ __('luxury.menu.empty') }}</p>
                    </article>
                @endforelse
            </section>

            @if ($pairings !== [])
                <section class="menu-pairing-band" aria-labelledby="menu-pairing-title">
                    <div class="section-header section-header-left">
                        <p class="section-kicker">{{ __('luxury.menu.pairing_kicker') }}</p>
                        <h2 id="menu-pairing-title" class="section-title">{{ __('luxury.menu.pairing_title') }}</h2>
                        <p class="section-lead">{{ __('luxury.menu.pairing_text') }}</p>
                    </div>

                    <div class="menu-pairing-grid">
                        @foreach ($pairings as $pairing)
                            <article class="menu-pairing-item">
                                <h3>{{ $pairing['title'] ?? '' }}</h3>
                                <p>{{ $pairing['text'] ?? '' }}</p>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

            @if (Lang::has('pages.menu_page.note'))
                <p class="muted menu-note">
                    {{ __('pages.menu_page.note') }}
                </p>
            @endif
        </div>
    </section>
</x-layouts.app>