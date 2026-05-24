<?php

namespace Tests\Feature;

use App\Data\ContactRequestData;
use App\Mail\ContactRequestMail;
use Tests\TestCase;

class LocalizationConsistencyTest extends TestCase
{
    /**
     * @var list<string>
     */
    private array $locales = ['it', 'en', 'de', 'fr', 'es'];

    public function test_contact_page_uses_locale_specific_content(): void
    {
        foreach ($this->locales as $locale) {
            $response = $this->get("/{$locale}/contatti");

            $response->assertOk();
            $response->assertSee(trans('pages.contacts.honeypot_label', [], $locale));
            $response->assertSee(trans('luxury.contacts.booking_title', [], $locale));

            $steps = trans('luxury.contacts.steps', [], $locale);
            $this->assertIsArray($steps);
            $this->assertNotEmpty($steps);

            $response->assertSee($steps[0]['title']);
            $response->assertSee($steps[1]['title']);

            if ($locale !== 'en') {
                $response->assertDontSee('Book a table, ask for private event availability or tell us what kind of evening you want to organise: we will answer with a clear proposal.');
                $response->assertDontSee('A few details are enough to plan dinner well.');
                $response->assertDontSee('We check availability and contact you to confirm.');
            }
        }
    }

    public function test_where_page_uses_translated_contact_labels(): void
    {
        foreach ($this->locales as $locale) {
            $response = $this->get("/{$locale}/dove-siamo");

            $response->assertOk();
            $response->assertSee(trans('pages.contacts.phone_label', [], $locale));
            $response->assertSee(trans('pages.contacts.email_label', [], $locale));
        }
    }

    public function test_contact_request_mail_uses_the_active_locale(): void
    {
        foreach ($this->locales as $locale) {
            app()->setLocale($locale);
            app()->setFallbackLocale('it');

            $mail = new ContactRequestMail(new ContactRequestData(
                name: 'Mario Rossi',
                email: 'mario@example.com',
                message: 'Messaggio di prova',
            ));

            $rendered = $mail->render();
            $subject = $mail->envelope()->subject;
            $restaurantName = config('restaurant.name', 'RISTORANTE');

            $this->assertSame(
                trans('mail.contact_request.subject', ['name' => $restaurantName], $locale),
                $subject,
            );

            $this->assertStringContainsString(
                trans('mail.contact_request.heading', ['name' => $restaurantName], $locale),
                $rendered,
            );

            $this->assertStringContainsString(
                trans('mail.contact_request.message_label', [], $locale),
                $rendered,
            );
        }
    }
}
