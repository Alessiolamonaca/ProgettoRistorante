<x-layouts.app
    :title="__('seo.menu.title')"
    :meta-description="__('seo.menu.description')"
>
    @php
        /**
         * @var \Illuminate\Support\Collection|\App\Models\Category[] $categories
         *
         * $categories è una collection di categorie, ognuna con:
         * - name   => nome della categoria (es. Antipasti, Primi)
         * - dishes => elenco piatti collegati
         */
        $locale   = request()->route('locale') ?? config('locales.default', 'it');
        $menuNote = __('pages.menu_page.note'); // eventuale nota finale sul menu
    @endphp

    {{-- 
        CONTENITORE PRINCIPALE PAGINA MENU
        - Usa .page per avere padding verticale coerente con il resto del sito
        - Tutto il contenuto del menu è dentro questa .container
    --}}
    <div class="container page">

        {{-- 
            BLOCCO HEADER PAGINA MENU
            - Titolo H1
            - Testo introduttivo (descrizione generale del menu)
        --}}
        <header class="page-header">
            <h1>{{ __('pages.menu_page.title') }}</h1>
            <p class="muted">
                {{ __('pages.menu_page.intro') }}
            </p>
        </header>

        {{-- 
            BLOCCO PRINCIPALE: CATEGORIE E PIATTI
            - Ogni categoria viene mostrata come una "card"
            - Dentro ogni card c'è l'elenco dei piatti:
              * nome piatto
              * descrizione (se presente)
              * prezzo (se presente)
            - Layout:
              * Mobile: 1 colonna
              * Desktop: 2 colonne (gestito da .grid nel layout)
        --}}
        <section class="grid">
            @foreach ($categories as $category)
                <article class="card">
                    {{-- Nome categoria (es. Antipasti, Primi, Secondi, Dolci, ecc.) --}}
                    <h2 class="menu-category-title">
                        {{ $category->name }}
                    </h2>

                    {{-- Elenco piatti della categoria --}}
                    <div class="menu-dishes">
                        @foreach ($category->dishes as $dish)
                            <div class="menu-dish-row">
                                {{-- Testo piatto: nome + descrizione --}}
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

                                {{-- Prezzo piatto (se presente) --}}
                                @if ($dish->formatted_price)
                                    <div class="menu-dish-price">
                                        {{ $dish->formatted_price }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </article>
            @endforeach
        </section>

        {{-- 
            BLOCCO NOTA FINALE DEL MENU
            - Mostrata solo se la traduzione esiste davvero
            - Utile per note tipo: "Coperto non incluso" o "Prodotti surgelati"
        --}}
        @if ($menuNote !== 'pages.menu_page.note')
            <p class="muted menu-note">
                {{ $menuNote }}
            </p>
        @endif
    </div>
</x-layouts.app>
