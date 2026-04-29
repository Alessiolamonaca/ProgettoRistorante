<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>Nuova richiesta dal sito</title>
</head>
<body>
    <h2>Nuova richiesta dal sito {{ config('restaurant.name', 'Ristorante') }}</h2>

    <p><strong>Nome:</strong> {{ $contactRequest->name }}</p>
    <p><strong>Email:</strong> {{ $contactRequest->email }}</p>

    <p><strong>Messaggio:</strong></p>
    <p style="white-space: pre-line;">
        {{ $contactRequest->message }}
    </p>

    <hr>
    <p style="font-size:12px; color:#666;">
        Messaggio inviato dal form contatti del sito {{ config('restaurant.name', 'Ristorante') }}.
    </p>
</body>
</html>
