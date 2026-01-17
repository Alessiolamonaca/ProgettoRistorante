<x-layouts.app
    :title="__('seo.restaurant.title')"
    :meta-description="__('seo.restaurant.description')"
>
    {{-- 
        SEZIONE PAGINA: "IL RISTORANTE"
        - Contenitore principale della pagina
        - Usa .page per avere padding verticale coerente con il resto del sito
    --}}
    <div class="container page">
        
        {{-- 
            BLOCCO: HEADER DELLA PAGINA
            - Titolo principale (H1)
            - Testo introduttivo (paragrafo muted)
        --}}
        <header class="page-header">
            <h1>{{ __('pages.restaurant.title') }}</h1>
            <p class="muted">
                {{ __('pages.restaurant.intro') }}
            </p>
        </header>

        {{-- 
            BLOCCO: CONTENUTI PRINCIPALI (4 CARD)
            - Ogni card racconta un aspetto del ristorante:
                1) Storia
                2) Cucina
                3) Sala
                4) Territorio
            - Layout:
                - Mobile: una card per riga (grid a 1 colonna)
                - Desktop: 2 card per riga (grid a 2 colonne, già gestito da .grid)
        --}}
        <section class="grid">
            <article class="card">
                <h2 class="page-section-title">
                    {{ __('pages.restaurant.story_title') }}
                </h2>
                <p class="muted">
                    {{ __('pages.restaurant.story_text') }}
                </p>
            </article>

            <article class="card">
                <h2 class="page-section-title">
                    {{ __('pages.restaurant.kitchen_title') }}
                </h2>
                <p class="muted">
                    {{ __('pages.restaurant.kitchen_text') }}
                </p>
            </article>

            <article class="card">
                <h2 class="page-section-title">
                    {{ __('pages.restaurant.room_title') }}
                </h2>
                <p class="muted">
                    {{ __('pages.restaurant.room_text') }}
                </p>
            </article>

            <article class="card">
                <h2 class="page-section-title">
                    {{ __('pages.restaurant.territory_title') }}
                </h2>
                <p class="muted">
                    {{ __('pages.restaurant.territory_text') }}
                </p>
            </article>
        </section>
    </div>
</x-layouts.app>
