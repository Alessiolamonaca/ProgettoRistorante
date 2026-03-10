<x-layouts.app
    :title="__('seo.contacts.title')"
    :meta-description="__('seo.contacts.description')"
>
    @php
        $restaurantName = config('restaurant.name', 'Ristorante');
        $addressLine    = config('restaurant.address_line');
        $phone          = config('restaurant.phone');
        $email          = config('restaurant.email');
        $whatsapp       = config('restaurant.whatsapp');

        $waNumber  = $whatsapp ? preg_replace('/\D+/', '', $whatsapp) : null;
        $phoneHref = $phone ? 'tel:' . preg_replace('/\D+/', '', $phone) : null;

        $locale = request()->route('locale') ?? config('locales.default', 'it');
        $action = route('contatti.submit', ['locale' => $locale]);
    @endphp

    <section class="page page-contacts">
        <div class="container">
            <header class="page-header">
                <h1>{{ __('pages.contacts.title') }}</h1>
                <p class="muted">
                    {{ __('pages.contacts.intro') }}
                </p>
            </header>

            {{-- Messaggio di successo --}}
            @if (session('success'))
                <div class="card" style="border-color: rgba(46,204,113,.7); background: rgba(46,204,113,.08); margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Errori di validazione --}}
            @if ($errors->any())
                <div class="card" style="border-color: rgba(231,76,60,.7); background: rgba(231,76,60,.08); margin-bottom:20px;">
                    <p style="margin-top:0; font-weight:600;">
                        {{ __('pages.contacts.form_error_title') ?? 'Per favore controlla i campi evidenziati.' }}
                    </p>
                    <ul style="margin:0; padding-left:18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid">
                {{-- Colonna informazioni di contatto --}}
                <article class="card">
                    <h2 style="margin-top:0; font-size:20px;">
                        {{ __('pages.contacts.info_title') }}
                    </h2>

                    <p class="muted">
                        {{ __('pages.contacts.info_text') }}
                    </p>

                    <div style="margin-top:16px;">
                        @if ($addressLine)
                            <p class="muted" style="margin:0 0 8px;">
                                <strong>{{ $restaurantName }}</strong><br>
                                {{ $addressLine }}
                            </p>
                        @endif

                        @if ($phone)
                            <p style="margin:0 0 6px;">
                                <strong>{{ __('pages.contacts.phone_label') }}:</strong>
                                <a href="{{ $phoneHref ?? '#' }}">{{ $phone }}</a>
                            </p>
                        @endif

                        @if ($email)
                            <p style="margin:0 0 6px;">
                                <strong>{{ __('pages.contacts.email_label') }}:</strong>
                                <a href="mailto:{{ $email }}">{{ $email }}</a>
                            </p>
                        @endif

                        @if ($waNumber)
                            <p style="margin:0 0 6px;">
                                <strong>{{ __('pages.contacts.whatsapp_label') }}:</strong>
                                <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener">
                                    {{ $whatsapp }}
                                </a>
                            </p>
                        @endif
                    </div>

                    @if ($phoneHref)
                        <div style="margin-top:18px;">
                            <a href="{{ $phoneHref }}" class="pill primary">
                                {{ __('pages.nav.book') }}
                            </a>
                        </div>
                    @endif
                </article>

                {{-- Colonna form contatti --}}
                <article class="card">
                    <h2 style="margin-top:0; font-size:20px;">
                        {{ __('pages.contacts.form_title') }}
                    </h2>

                    <form
                        method="POST"
                        action="{{ $action }}"
                        style="margin-top:12px; display:flex; flex-direction:column; gap:12px;"
                    >
                        @csrf

                        <div>
                            <label for="name" style="display:block; margin-bottom:4px;">
                                {{ __('pages.contacts.form_name') }}
                            </label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                style="width:100%; padding:8px 10px; border-radius:8px; border:1px solid rgba(255,255,255,.18); background:#141414; color:#f5f5f5;"
                            >
                        </div>

                        <div>
                            <label for="email" style="display:block; margin-bottom:4px;">
                                {{ __('pages.contacts.form_email') }}
                            </label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                style="width:100%; padding:8px 10px; border-radius:8px; border:1px solid rgba(255,255,255,.18); background:#141414; color:#f5f5f5;"
                            >
                        </div>

                        <div>
                            <label for="message" style="display:block; margin-bottom:4px;">
                                {{ __('pages.contacts.form_message') }}
                            </label>
                            <textarea
                                id="message"
                                name="message"
                                rows="4"
                                style="width:100%; padding:8px 10px; border-radius:8px; border:1px solid rgba(255,255,255,.18); background:#141414; color:#f5f5f5; resize:vertical;"
                            >{{ old('message') }}</textarea>
                        </div>

                        <div style="margin-top:4px;">
                            <button type="submit" class="pill primary">
                                {{ __('pages.contacts.form_submit') }}
                            </button>
                        </div>
                    </form>

                    @if(__('pages.contacts.note') !== 'pages.contacts.note')
                        <p class="muted" style="margin-top:12px;">
                            {{ __('pages.contacts.note') }}
                        </p>
                    @endif
                </article>
            </div>
        </div>
    </section>
</x-layouts.app>
