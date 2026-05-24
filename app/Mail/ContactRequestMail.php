<?php

namespace App\Mail;

use App\Data\ContactRequestData;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ContactRequestData $contactRequest,
    ) {
    }

    public function envelope(): Envelope
    {
        $restaurantName = config('restaurant.name', 'RISTORANTE');

        return new Envelope(
            subject: __('mail.contact_request.subject', ['name' => $restaurantName]),
            replyTo: [
                new Address($this->contactRequest->email, $this->contactRequest->name),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.contact_request',
        );
    }
}
