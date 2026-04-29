<?php

namespace App\Http\Controllers;

use App\Data\ContactRequestData;
use App\Http\Requests\StoreContactRequest;
use App\Services\ContactRequestSender;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function __construct(
        private readonly ContactRequestSender $contactRequestSender,
    ) {
    }

    public function __invoke(StoreContactRequest $request, string $locale): RedirectResponse
    {
        $recipient = config('restaurant.email');

        if (! is_string($recipient) || $recipient === '') {
            Log::warning('Contact request could not be delivered because no recipient is configured.', [
                'locale' => $locale,
            ]);

            return back()
                ->withInput()
                ->withErrors(['contact' => __('pages.contacts.send_error')]);
        }

        $contactRequest = ContactRequestData::fromValidatedInput(
            $request->safe()->only(['name', 'email', 'message'])
        );

        if (! $this->contactRequestSender->send($contactRequest, $recipient, $locale)) {
            return back()
                ->withInput()
                ->withErrors(['contact' => __('pages.contacts.send_error')]);
        }

        return back()->with('success', __('pages.contacts.success'));
    }
}
