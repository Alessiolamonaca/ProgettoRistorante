<?php

return [
    // Nome visualizzato nel sito (header, footer, meta tag)
    'name'         => env('RESTAURANT_NAME', 'RISTORANTE'),

    // Recapiti principali
    'phone'        => env('RESTAURANT_PHONE', '+39 333 9856412'),
    'email'        => env('RESTAURANT_EMAIL', 'info@example.com'),

    // Numero WhatsApp mostrato nella pagina contatti
    // Sostituisci con il numero reale oppure imposta a null se non vuoi mostrarlo
    'whatsapp'     => env('RESTAURANT_WHATSAPP'),

    // Riga indirizzo usata in footer e pagina "Dove siamo"
    'address_line' => env('RESTAURANT_ADDRESS_LINE', 'Via Esempio 1, 00000 Città (Provincia)'),

    // Testo per la ricerca su Google Maps (pagina "Dove siamo")
    'maps_query'   => env('RESTAURANT_MAPS_QUERY', 'RISTORANTE, Italia'),

    // URL (o path) di un'immagine usata per la condivisione social (Open Graph)
    // Puoi usare un path relativo, es: '/images/hero-sala.jpg'
    'og_image'     => env('RESTAURANT_OG_IMAGE', '/images/hero-sala.jpg'),

    // Nome del sito/brand per i meta Open Graph
    'site_name'    => env('RESTAURANT_SITE_NAME', env('RESTAURANT_NAME', 'RISTORANTE')),

    // URL social: metti null se non usi uno dei due
    'instagram'    => env('RESTAURANT_INSTAGRAM'),
    'facebook'     => env('RESTAURANT_FACEBOOK'),
];
