<x-layouts.app
    :title="__('seo.home.title')"
    :meta-description="__('seo.home.description')"
>
    {{-- 
        SEZIONE HERO HOME
        - Sfondo con 3 immagini in rotazione
        - Testo centrato (titolo + sottotitolo)
        - Navigazione con frecce laterali + autoplay
    --}}
    <section class="hero hero-home" data-hero-bg>
        {{-- Sfondo con 3 immagini in rotazione --}}
        <div class="hero-bg-track">
            <div
                class="hero-bg-slide is-active"
                data-hero-bg-slide
                style="background-image: url('{{ asset('images/ristorante-esterno.jpg') }}');"
            ></div>

            <div
                class="hero-bg-slide"
                data-hero-bg-slide
                style="background-image: url('{{ asset('images/sala.jpg') }}');"
            ></div>

            <div
                class="hero-bg-slide"
                data-hero-bg-slide
                style="background-image: url('{{ asset('images/braceria-2.jpg') }}');"
            ></div>
        </div>

        {{-- Contenuto centrato sopra lo sfondo --}}
        <div class="hero-content-center">
            <div class="container">
                <h1 class="hero-heading hero-heading-center">
                    Torre di Blaga
                </h1>

                <p class="hero-lead hero-lead-center">
                    Agriturismo con cucina tipica abruzzese:
                    carne alla brace, arrosticini e pizza.
                </p>
            </div>
        </div>

        {{-- Frecce di navigazione laterali --}}
        <button
            type="button"
            class="hero-bg-arrow hero-bg-arrow-left"
            data-hero-bg-prev
            aria-label="Immagine precedente"
        >
            <span>&lsaquo;</span>
        </button>

        <button
            type="button"
            class="hero-bg-arrow hero-bg-arrow-right"
            data-hero-bg-next
            aria-label="Immagine successiva"
        >
            <span>&rsaquo;</span>
        </button>
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

    {{-- SCRIPT: carousel di sfondo hero (desktop + mobile) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hero = document.querySelector('[data-hero-bg]');
            if (!hero) return;

            const slides = hero.querySelectorAll('[data-hero-bg-slide]');
            const prevBtn = hero.querySelector('[data-hero-bg-prev]');
            const nextBtn = hero.querySelector('[data-hero-bg-next]');

            if (slides.length <= 1) return;

            let currentIndex = 0;
            let timerId = null;

            function showSlide(index) {
                slides[currentIndex].classList.remove('is-active');

                // gestione indice circolare
                const total = slides.length;
                currentIndex = ((index % total) + total) % total;

                slides[currentIndex].classList.add('is-active');
            }

            function nextSlide() {
                showSlide(currentIndex + 1);
            }

            function prevSlide() {
                showSlide(currentIndex - 1);
            }

            function startAutoPlay() {
                stopAutoPlay();
                // cambia sfondo ogni 3 secondi
                timerId = setInterval(nextSlide, 3000);
            }

            function stopAutoPlay() {
                if (timerId !== null) {
                    clearInterval(timerId);
                    timerId = null;
                }
            }

            // click freccia destra
            if (nextBtn) {
                nextBtn.addEventListener('click', function () {
                    nextSlide();
                    startAutoPlay();
                });
            }

            // click freccia sinistra
            if (prevBtn) {
                prevBtn.addEventListener('click', function () {
                    prevSlide();
                    startAutoPlay();
                });
            }

            // pausa al passaggio del mouse (solo desktop)
            hero.addEventListener('mouseenter', stopAutoPlay);
            hero.addEventListener('mouseleave', startAutoPlay);

            // inizializzazione
            showSlide(0);
            startAutoPlay();
        });
    </script>
</x-layouts.app>
