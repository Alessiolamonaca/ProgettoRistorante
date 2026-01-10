<x-layouts.app
    :title="__('seo.contacts.title')"
    :meta-description="__('seo.contacts.description')"
>
    <div class="container" style="padding-top: 24px;">

        {{-- Messaggio di successo --}}
        @if (session('success'))
            <div class="card" style="margin-bottom: 16px; border-color: rgba(46,204,113,.6);">
                <p class="muted" style="margin:0; color:#2ecc71;">
                    {{ session('success') }}
                </p>
            </div>
        @endif

        {{-- Errori di validazione --}}
        @if ($errors->any())
            <div class="card" style="margin-bottom: 16px; border-color: rgba(231,76,60,.6);">
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li class="muted">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid">
            <div class="card">
                <h1 style="margin-top:0;">{{ __('pages.contacts.title') }}</h1>
                <p class="muted">
                    {{ __('pages.contacts.text') }}
                </p>

                @php
                    $phone    = config('restaurant.phone');
                    $email    = config('restaurant.email');
                    $whatsapp = config('restaurant.whatsapp');
                    $address  = config('restaurant.address_line');
                @endphp


                <div style="margin-top:16px;">
                    <p><strong>{{ __('pages.contacts.phone_label') }}:</strong> {{ $phone }}</p>
                    <p><strong>{{ __('pages.contacts.email_label') }}:</strong> {{ $email }}</p>
                    <p><strong>{{ __('pages.contacts.whatsapp_label') }}:</strong> {{ $whatsapp }}</p>
                    <p><strong>{{ __('pages.contacts.address_label') }}:</strong> {{ $address }}</p>
                </div>

                <div style="margin-top:16px; display:flex; gap:12px; flex-wrap:wrap;">
                    <a class="pill primary" href="tel:{{ preg_replace('/\s+/', '', $phone) }}">
                        {{ __('pages.contacts.phone_label') }}
                    </a>
                    <a class="pill" href="mailto:{{ $email }}">
                        {{ __('pages.contacts.email_label') }}
                    </a>
                    <a class="pill" href="https://wa.me/{{ preg_replace('/\D+/', '', $whatsapp) }}" target="_blank" rel="noopener">
                        {{ __('pages.contacts.whatsapp_label') }}
                    </a>
                </div>
            </div>

            <div class="card">
                <h2 style="margin-top:0; font-size:20px;">{{ __('pages.contacts.booking_title') }}</h2>
                <p class="muted">
                    {{ __('pages.contacts.booking_text') }}
                </p>

                <h3 style="margin-top:16px; font-size:18px;">{{ __('pages.contacts.note_title') }}</h3>
                <p class="muted">
                    {{ __('pages.contacts.note_text') }}
                </p>

                <hr style="margin:16px 0; border-color: rgba(255,255,255,.08);">

                <h2 style="margin-top:0; font-size:20px;">{{ __('pages.contacts.form_title') }}</h2>

                <form method="POST" action="{{ route('contatti.submit', ['locale' => request()->route('locale')]) }}">
                    @csrf

                    <div style="margin-bottom:12px;">
                        <label for="name" style="display:block; font-size:14px; margin-bottom:4px;">
                            {{ __('pages.contacts.form_name') }}
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            style="width:100%; padding:8px 10px; border-radius:8px; border:1px solid rgba(255,255,255,.18); background:rgba(0,0,0,.4); color:#f3f3f3;">
                    </div>

                    <div style="margin-bottom:12px;">
                        <label for="email" style="display:block; font-size:14px; margin-bottom:4px;">
                            {{ __('pages.contacts.form_email') }}
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            style="width:100%; padding:8px 10px; border-radius:8px; border:1px solid rgba(255,255,255,.18); background:rgba(0,0,0,.4); color:#f3f3f3;">
                    </div>

                    <div style="margin-bottom:12px;">
                        <label for="message" style="display:block; font-size:14px; margin-bottom:4px;">
                            {{ __('pages.contacts.form_message') }}
                        </label>
                        <textarea
                            id="message"
                            name="message"
                            rows="4"
                            style="width:100%; padding:8px 10px; border-radius:8px; border:1px solid rgba(255,255,255,.18); background:rgba(0,0,0,.4); color:#f3f3f3;">{{ old('message') }}</textarea>
                    </div>

                    <button
                        type="submit"
                        class="pill primary"
                        style="margin-top:4px; border:none; cursor:pointer;">
                        {{ __('pages.contacts.form_send') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
