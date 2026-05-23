<x-layouts.app
    :title="__('seo.contacts.title')"
    :meta-description="__('seo.contacts.description')"
>
    @php
        $restaurantName = config('restaurant.name', 'RISTORANTE');
        $addressLine = config('restaurant.address_line');
        $phone = config('restaurant.phone');
        $email = config('restaurant.email');
        $whatsapp = config('restaurant.whatsapp');

        $waNumber = $whatsapp ? preg_replace('/\D+/', '', $whatsapp) : null;
        $phoneHref = $phone ? 'tel:'.preg_replace('/\D+/', '', $phone) : null;

        $locale = request()->route('locale') ?? config('locales.default', 'it');
        $action = route('contatti.submit', ['locale' => $locale]);
        $contactServices = trans('pages.contacts.services_list');
        $contactMessageTips = trans('pages.contacts.form_tips_list');

        $bookingSteps = trans('luxury.contacts.steps');
        $bookingSteps = is_array($bookingSteps) ? $bookingSteps : [];

        $occasionCards = trans('luxury.contacts.occasions');
        $occasionCards = is_array($occasionCards) ? $occasionCards : [];
    @endphp

    <section class="page page-contacts">
        <div class="container">
            <header class="page-header" data-collapse-on-scroll>
                <h1>{{ __('pages.contacts.title') }}</h1>
                <p class="muted">
                    {{ __('luxury.contacts.intro') }}
                </p>
            </header>

            <section class="booking-brief" aria-labelledby="booking-brief-title">
                <div class="booking-brief-main">
                    <p class="section-kicker">{{ __('luxury.contacts.booking_kicker') }}</p>
                    <h2 id="booking-brief-title" class="section-title">{{ __('luxury.contacts.booking_title') }}</h2>
                    <p>{{ __('luxury.contacts.booking_text') }}</p>

                    <div class="contact-card-actions">
                        @if ($phoneHref)
                            <a href="{{ $phoneHref }}" class="pill primary">
                                {{ __('pages.contacts.call_cta') }}
                            </a>
                        @endif

                        @if ($waNumber)
                            <a href="https://wa.me/{{ $waNumber }}" class="pill" target="_blank" rel="noopener">
                                {{ __('pages.contacts.whatsapp_cta') }}
                            </a>
                        @endif
                    </div>
                </div>

                @if ($bookingSteps !== [])
                    <div class="booking-steps">
                        @foreach ($bookingSteps as $step)
                            <article class="booking-step">
                                <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <h3>{{ $step['title'] ?? '' }}</h3>
                                <p>{{ $step['text'] ?? '' }}</p>
                            </article>
                        @endforeach
                    </div>
                @endif
            </section>

            @if (session('success'))
                <div class="card contact-status contact-status-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="card contact-status contact-status-error">
                    <p style="margin-top:0; font-weight:600;">
                        {{ __('pages.contacts.form_error_title') }}
                    </p>
                    <ul style="margin:0; padding-left:18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid">
                <article class="card contact-card contact-card-info">
                    <p class="contact-card-kicker">
                        {{ __('pages.contacts.info_kicker') }}
                    </p>

                    <h2 class="contact-card-title">
                        {{ __('pages.contacts.info_title') }}
                    </h2>

                    <p class="muted contact-card-intro">
                        {{ __('pages.contacts.info_text') }}
                    </p>

                    @if (is_array($contactServices) && $contactServices !== [])
                        <section class="contact-card-section">
                            <h3 class="contact-card-section-title">
                                {{ __('pages.contacts.services_title') }}
                            </h3>

                            <ul class="contact-check-list">
                                @foreach ($contactServices as $service)
                                    <li>{{ $service }}</li>
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    <section class="contact-card-section">
                        <h3 class="contact-card-section-title">
                            {{ __('pages.contacts.direct_title') }}
                        </h3>

                        <div class="contact-info-list">
                            @if ($addressLine)
                                <div class="contact-info-row">
                                    <span class="contact-info-label">{{ $restaurantName }}</span>
                                    <span class="contact-info-value">{{ $addressLine }}</span>
                                </div>
                            @endif

                            @if ($phone)
                                <div class="contact-info-row">
                                    <span class="contact-info-label">{{ __('pages.contacts.phone_label') }}</span>
                                    <a class="contact-info-value" href="{{ $phoneHref ?? '#' }}">{{ $phone }}</a>
                                </div>
                            @endif

                            @if ($email)
                                <div class="contact-info-row">
                                    <span class="contact-info-label">{{ __('pages.contacts.email_label') }}</span>
                                    <a class="contact-info-value" href="mailto:{{ $email }}">{{ $email }}</a>
                                </div>
                            @endif

                            @if ($waNumber)
                                <div class="contact-info-row">
                                    <span class="contact-info-label">{{ __('pages.contacts.whatsapp_label') }}</span>
                                    <a
                                        class="contact-info-value"
                                        href="https://wa.me/{{ $waNumber }}"
                                        target="_blank"
                                        rel="noopener"
                                    >
                                        {{ $whatsapp }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </section>

                    <section class="contact-card-section">
                        <h3 class="contact-card-section-title">
                            {{ __('pages.contacts.response_title') }}
                        </h3>

                        <p class="muted contact-card-intro">
                            {{ __('pages.contacts.response_text') }}
                        </p>
                    </section>

                    @if ($occasionCards !== [])
                        <section class="contact-card-section">
                            <h3 class="contact-card-section-title">
                                {{ __('luxury.contacts.occasions_title') }}
                            </h3>

                            <div class="contact-occasion-grid">
                                @foreach ($occasionCards as $occasion)
                                    <article class="contact-occasion">
                                        <h4>{{ $occasion['title'] ?? '' }}</h4>
                                        <p>{{ $occasion['text'] ?? '' }}</p>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <div class="contact-card-actions">
                        @if ($phoneHref)
                            <a href="{{ $phoneHref }}" class="pill primary">
                                {{ __('pages.contacts.call_cta') }}
                            </a>
                        @endif

                        @if ($waNumber)
                            <a href="https://wa.me/{{ $waNumber }}" class="pill" target="_blank" rel="noopener">
                                {{ __('pages.contacts.whatsapp_cta') }}
                            </a>
                        @endif
                    </div>
                </article>

                <article class="card contact-card contact-card-form">
                    <p class="contact-card-kicker">
                        {{ __('pages.contacts.form_kicker') }}
                    </p>

                    <h2 class="contact-card-title">
                        {{ __('pages.contacts.form_title') }}
                    </h2>

                    <p class="muted contact-card-intro">
                        {{ __('pages.contacts.form_intro') }}
                    </p>

                    <form
                        method="POST"
                        action="{{ $action }}"
                        class="contact-form"
                    >
                        @csrf

                        <div style="position:absolute; left:-9999px; width:1px; height:1px; overflow:hidden;" aria-hidden="true">
                            <label for="company">Company</label>
                            <input
                                id="company"
                                name="company"
                                type="text"
                                tabindex="-1"
                                autocomplete="off"
                                value=""
                            >
                        </div>

                        <div class="contact-field">
                            <label for="name" class="contact-label">
                                {{ __('pages.contacts.form_name') }}
                            </label>

                            <input
                                id="name"
                                name="name"
                                type="text"
                                class="contact-input{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                value="{{ old('name') }}"
                                autocomplete="name"
                                maxlength="255"
                                required
                                aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                                @if ($errors->has('name'))
                                    aria-describedby="name-error"
                                @endif
                            >

                            @error('name')
                                <p id="name-error" class="contact-field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="contact-field">
                            <label for="email" class="contact-label">
                                {{ __('pages.contacts.form_email') }}
                            </label>

                            <input
                                id="email"
                                name="email"
                                type="email"
                                class="contact-input{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                maxlength="255"
                                required
                                aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                                @if ($errors->has('email'))
                                    aria-describedby="email-error"
                                @endif
                            >

                            @error('email')
                                <p id="email-error" class="contact-field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="contact-field">
                            <label for="message" class="contact-label">
                                {{ __('pages.contacts.form_message') }}
                            </label>

                            <textarea
                                id="message"
                                name="message"
                                class="contact-textarea{{ $errors->has('message') ? ' is-invalid' : '' }}"
                                rows="4"
                                maxlength="2000"
                                required
                                aria-invalid="{{ $errors->has('message') ? 'true' : 'false' }}"
                                @if ($errors->has('message'))
                                    aria-describedby="message-error"
                                @endif
                            >{{ old('message') }}</textarea>

                            @error('message')
                                <p id="message-error" class="contact-field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="contact-form-actions">
                            <button type="submit" class="pill primary">
                                {{ __('pages.contacts.form_submit') }}
                            </button>
                        </div>
                    </form>

                    @if (is_array($contactMessageTips) && $contactMessageTips !== [])
                        <section class="contact-form-note">
                            <h3 class="contact-card-section-title">
                                {{ __('pages.contacts.form_tips_title') }}
                            </h3>

                            <ul class="contact-check-list contact-check-list-compact">
                                @foreach ($contactMessageTips as $tip)
                                    <li>{{ $tip }}</li>
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    @if (Lang::has('pages.contacts.note'))
                        <p class="contact-form-confirmation">
                            {{ __('pages.contacts.note') }}
                        </p>
                    @endif
                </article>
            </div>
        </div>
    </section>
</x-layouts.app>