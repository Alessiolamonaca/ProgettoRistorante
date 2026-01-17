<x-layouts.app
    :title="__('seo.home.title')"
    :meta-description="__('seo.home.description')"
>
    {{-- 
        SEZIONE HERO HOME
        - Colonna sinistra: titolo, sottotitolo, call-to-action (Menu / Dove siamo)
        - Colonna destra: immagine con slider automatico + piccola galleria
        - La griglia è 1 colonna su mobile e 2 colonne su desktop
    --}}
    <section class="hero">
        <div class="container grid">
            {{-- Colonna testo (titolo + CTA) --}}
            <div>
                <h1 class="hero-heading">
                    {{ __('pages.home.title') }}
                </h1>

                <p class="muted hero-lead">
                    {{ __('pages.home.subtitle') }}
                </p>

                <div class="hero-actions">
                    <a
                        class="pill primary"
                        href="{{ route('menu', ['locale' => request()->route('locale')]) }}"
                    >
                        {{ __('pages.home.cta_menu') }}
                    </a>

                    <a
                        class="pill"
                        href="{{ route('dove-siamo', ['locale' => request()->route('locale')]) }}"
                    >
                        {{ __('pages.home.cta_where') }}
                    </a>
                </div>
            </div>

            {{-- Colonna immagine (slider + mini-galleria) --}}
            <div class="card">
                {{-- HERO con slider automatico:
                    - background iniziale = hero-sala
                    - data-images contiene le immagini che lo script ruota
                --}}
                <div
                    class="hero-image"
                    id="hero-slider"
                    data-images='["/images/hero-sala.jpg","/images/piatto-1.jpg","/images/piatto-2.jpg"]'
                    style="background-image: url('/images/hero-sala.jpg');"
                ></div>

                {{-- Piccola galleria statica sotto lo slider --}}
                <div class="gallery">
                    <img src="/images/piatto-1.jpg" alt="Piatto 1">
                    <img src="/images/piatto-2.jpg" alt="Piatto 2">
                    <img src="/images/esterno-1.jpg" alt="Esterno del ristorante">
                </div>
            </div>
        </div>
    </section>

    {{-- 
        SEZIONE INFORMATIVA (3 CARD)
        - Info generali (testo introduttivo)
        - Stile cucina / ambiente
        - Prenotazioni / note pratiche
        - Su mobile: 1 colonna
        - Su desktop: 3 colonne affiancate
    --}}
    <section class="home-info">
        <div class="container">
            <div class="grid grid-3">
                <div class="card">
                    <h3 class="home-card-title">
                        {{ __('pages.home.info_title') }}
                    </h3>
                    <p class="muted">
                        {{ __('pages.home.info_text') }}
                    </p>
                </div>

                <div class="card">
                    <h3 class="home-card-title">
                        {{ __('pages.home.style_title') }}
                    </h3>
                    <p class="muted">
                        {{ __('pages.home.style_text') }}
                    </p>
                </div>

                <div class="card">
                    <h3 class="home-card-title">
                        {{ __('pages.home.book_title') }}
                    </h3>
                    <p class="muted">
                        {{ __('pages.home.book_text') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
