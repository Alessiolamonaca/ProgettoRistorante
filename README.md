# RISTORANTE

Sito vetrina multilingua per ristorante, costruito con Laravel 12, Filament 3 e Vite.

## Stack

- PHP 8.2+
- Laravel 12
- Filament 3.3
- MySQL o SQLite
- Vite

## Avvio locale con Bash

```bash
cd /c/Users/lamon/Desktop/ProgettoRistorante/ristorante
```

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
composer run dev
```

Il comando `composer run dev` avvia Laravel su `http://127.0.0.1:8000`, la coda, i log e Vite.

## Build

```bash
npm run build
```

## Test

```bash
php artisan test
composer audit --locked --no-interaction
npm audit --omit=dev --audit-level=moderate
```

## Variabili importanti

Imposta almeno queste variabili prima del deploy:

- `APP_ENV`
- `APP_DEBUG`
- `APP_URL`
- `APP_KEY`
- `DB_*`
- `MAIL_*`
- `RESTAURANT_*`
- `ADMIN_EMAIL`
- `ADMIN_PASSWORD`

## Checklist pre-produzione

- Imposta `APP_ENV=production`
- Imposta `APP_DEBUG=false`
- Configura `APP_URL` con il dominio finale `https://...`
- Genera una chiave valida con `php artisan key:generate`
- Configura SMTP reale e verifica l'invio del form contatti
- Imposta un utente admin tramite `ADMIN_EMAIL` e `ADMIN_PASSWORD`
- Esegui `php artisan migrate --force`
- Esegui `php artisan optimize`
- Verifica che il server forzi HTTPS
- Configura backup del database e rotazione log

## Note operative

- Il form contatti è protetto da CSRF, honeypot e rate limiting.
- Gli header HTTP di sicurezza vengono aggiunti dal middleware applicativo.
- L'accesso al pannello admin è consentito solo all'utente configurato.# ProgettoRistorante
