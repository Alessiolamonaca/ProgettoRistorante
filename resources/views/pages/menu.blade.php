<x-layouts.app
    :title="__('seo.menu.title')"
    :meta-description="__('seo.menu.description')"
>
    @php
        /** @var \Illuminate\Support\Collection|\App\Models\Category[] $categories */
        $locale   = request()->route('locale') ?? config('locales.default', 'it');
        $menuNote = __('pages.menu_page.note');
    @endphp

    <div class="container page">
        <div class="page-header">
            <h1>{{ __('pages.menu_page.title') }}</h1>
            <p class="muted">
                {{ __('pages.menu_page.intro') }}
            </p>
        </div>

        <div class="grid">
            @foreach ($categories as $category)
                <section class="card">
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

                                    @if($dish->description)
                                        <p class="menu-dish-description muted">
                                            {{ $dish->description }}
                                        </p>
                                    @endif
                                </div>

                                @if($dish->formatted_price)
                                    <div class="menu-dish-price">
                                        {{ $dish->formatted_price }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>

        @if($menuNote !== 'pages.menu_page.note')
            <p class="muted menu-note">
                {{ $menuNote }}
            </p>
        @endif
    </div>
</x-layouts.app>
