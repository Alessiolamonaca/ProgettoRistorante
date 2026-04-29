<?php

namespace Tests\Feature;

use App\Mail\ContactRequestMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_sends_mail_and_flashes_success(): void
    {
        Mail::fake();
        config(['restaurant.email' => 'bookings@example.com']);

        $response = $this->from('/it/contatti')->post('/it/contatti', [
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'message' => 'Vorrei prenotare per sabato sera.',
            'company' => '',
        ]);

        $response->assertRedirect('/it/contatti');
        $response->assertSessionHas('success');

        Mail::assertSent(ContactRequestMail::class, function (ContactRequestMail $mail): bool {
            return $mail->hasTo('bookings@example.com');
        });
    }

    public function test_contact_form_rejects_honeypot_submissions(): void
    {
        Mail::fake();
        config(['restaurant.email' => 'bookings@example.com']);

        $response = $this->from('/it/contatti')->post('/it/contatti', [
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'message' => 'Messaggio di test.',
            'company' => 'Spam Bot Ltd',
        ]);

        $response->assertRedirect('/it/contatti');
        $response->assertSessionHasErrors('contact');
        Mail::assertNothingSent();
    }

    public function test_contact_form_is_rate_limited(): void
    {
        Mail::fake();
        config(['restaurant.email' => 'bookings@example.com']);

        foreach (range(1, 5) as $attempt) {
            $response = $this->post('/it/contatti', [
                'name' => 'Mario Rossi',
                'email' => 'mario@example.com',
                'message' => 'Tentativo '.$attempt,
                'company' => '',
            ]);

            $response->assertRedirect();
        }

        $response = $this->post('/it/contatti', [
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'message' => 'Tentativo extra',
            'company' => '',
        ]);

        $response->assertStatus(429);
    }
}
