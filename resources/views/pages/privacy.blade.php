<x-layouts.app
    :title="__('pages.privacy.title')"
    :meta-description="__('pages.privacy.intro')"
>
    <section class="page">
        <div class="container">
            {{-- Header pagina --}}
            <header class="page-header">
                <h1>{{ __('pages.privacy.title') }}</h1>
                <p class="muted">
                    {{ __('pages.privacy.intro') }}
                </p>
            </header>

            {{-- Blocco: dati raccolti --}}
            <article class="card">
                <h2 class="page-section-title">
                    {{ __('pages.privacy.data_title') }}
                </h2>
                <p class="muted">
                    {{ __('pages.privacy.data_text') }}
                </p>
            </article>

            {{-- Blocco: cookie --}}
            <article class="card" style="margin-top:16px;">
                <h2 class="page-section-title">
                    {{ __('pages.privacy.cookies_title') }}
                </h2>
                <p class="muted">
                    {{ __('pages.privacy.cookies_text') }}
                </p>
            </article>

            {{-- Blocco: contatti titolare --}}
            <article class="card" style="margin-top:16px;">
                <h2 class="page-section-title">
                    {{ __('pages.privacy.contacts_title') }}
                </h2>
                <p class="muted">
                    {{ __('pages.privacy.contacts_text') }}
                </p>
            </article>
        </div>
    </section>
</x-layouts.app>
