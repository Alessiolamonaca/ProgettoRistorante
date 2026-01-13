<x-layouts.app
    :title="__('seo.menu.title')"
    :meta-description="__('seo.menu.description')"
>
    <div class="container" style="padding-top: 24px;">

        <div class="card" style="margin-bottom: 20px;">
            <h1 style="margin-top:0;">{{ __('pages.menu_page.title') }}</h1>
            <p class="muted">
                {{ __('pages.menu_page.intro') }}
            </p>
        </div>

        @if ($categories->isEmpty())
            <div class="card">
                <p class="muted" style="margin:0;">
                    (Menu non ancora disponibile.)
                </p>
            </div>
        @else
            <div class="grid">
                @foreach ($categories as $category)
                    <div class="card">
                        <h2 style="margin-top:0; font-size:20px;">
                            {{ $category->name }}
                        </h2>

                        @forelse ($category->dishes as $dish)
                            <div style="display:flex; justify-content:space-between; gap:16px; margin-bottom:10px;">
                                <div>
                                    <strong>{{ $dish->name }}</strong>
                                    @if ($dish->description)
                                        <p class="muted" style="margin:4px 0 0;">
                                            {{ $dish->description }}
                                        </p>
                                    @endif
                                </div>

                                @if ($dish->formatted_price)
                                    <div style="white-space:nowrap;">
                                        € {{ $dish->formatted_price }}
                                    </div>
                                @endif
                            </div>
                        @empty
                            <p class="muted" style="margin:0;">
                                (Nessun piatto disponibile in questa categoria.)
                            </p>
                        @endforelse
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts.app>
