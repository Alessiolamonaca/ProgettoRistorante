<x-layouts.app title="{{ __('pages.where.title') }}">
    <div class="container" style="padding-top: 24px;">
        <div class="card">
            <h1 style="margin-top:0;">{{ __('pages.where.title') }}</h1>
            <p class="muted">
                {{___('pages.where.text')}}
            </p>

            @php
                $destination = urlencode('Torre di Blaga, Italia');
                $mapsUrl     = "https://www.google.com/maps/search/?api=1&query={$destination}";
            @endphp

            <div style="margin-top:16px; display:flex; gap:12px; flex-wrap:wrap;">
                <a class="pill primary" href="{{ $mapsUrl }}" target="_blank" rel="noopener">
                    {{__('pages.whare.cta_maps')}}
                </a>
                <a class="pill" href="/{{ request()->route('locale') }}/contatti">
                    {{__('pages.whare.cta_contact')}}
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
