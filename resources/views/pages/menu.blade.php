<x-layouts.app title="{{ __('pages.menu_page.title') }}">
    <div class="container" style="padding-top: 24px;">
        <div class="card" style="margin-bottom: 20px;">
            <h1 style="margin-top:0;">{{ __('pages.menu_page.title') }}</h1>
            <p class="muted">
                {{ __('pages.menu_page.text') }}
            </p>
        </div>

        @php
            // Carichiamo le sezioni del menu dalla traduzione corrente
            $menu = __('menu.sections');
        @endphp

        <div class="grid">
            @foreach ($menu as $section)
                <div class="card">
                    <h2 style="margin-top:0; font-size: 20px;">
                        {{ $section['title'] }}
                    </h2>

                    @foreach ($section['items'] as $dish)
                        <div style="margin-bottom: 12px;">
                            <div style="display:flex; justify-content:space-between; gap:12px;">
                                <strong>{{ $dish['name'] }}</strong>
                                <span class="muted">{{ $dish['price'] }}</span>
                            </div>
                            @if(!empty($dish['desc']))
                                <div class="muted" style="font-size: 14px; margin-top: 2px;">
                                    {{ $dish['desc'] }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>
