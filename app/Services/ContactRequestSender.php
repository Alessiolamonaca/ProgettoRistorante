<?php

namespace App\Services;

use App\Data\ContactRequestData;
use App\Mail\ContactRequestMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactRequestSender
{
    public function send(ContactRequestData $contactRequest, string $recipient, string $locale): bool
    {
        try {
            Mail::to($recipient)->send(new ContactRequestMail($contactRequest));
        } catch (\Throwable $exception) {
            Log::error('Contact request delivery failed.', [
                'locale'    => $locale,
                'exception' => $exception,
            ]);

            return false;
        }

        return true;
    }
}
