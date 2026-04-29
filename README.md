# Torre di Blaga

Sito vetrina multilingua per ristorante/agriturismo costruito con Laravel 12, Filament 3 e Vite.

## Stack

- PHP 8.2+
- Laravel 12
- Filament 3.3
- SQLite/MySQL
- Vite

## Avvio locale

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan serve
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
- L'accesso al pannello admin è consentito solo all'utente configurato.
