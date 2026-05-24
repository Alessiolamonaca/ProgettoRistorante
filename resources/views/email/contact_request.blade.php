<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>{{ __('mail.contact_request.subject', ['name' => config('restaurant.name', 'RISTORANTE')]) }}</title>
</head>
<body>
    <h2>{{ __('mail.contact_request.heading', ['name' => config('restaurant.name', 'RISTORANTE')]) }}</h2>

    <p><strong>{{ __('mail.contact_request.name_label') }}:</strong> {{ $contactRequest->name }}</p>
    <p><strong>{{ __('mail.contact_request.email_label') }}:</strong> {{ $contactRequest->email }}</p>

    <p><strong>{{ __('mail.contact_request.message_label') }}:</strong></p>
    <p style="white-space: pre-line;">
        {{ $contactRequest->message }}
    </p>

    <hr>
    <p style="font-size:12px; color:#666;">
        {{ __('mail.contact_request.footer', ['name' => config('restaurant.name', 'RISTORANTE')]) }}
    </p>
</body>
</html>
