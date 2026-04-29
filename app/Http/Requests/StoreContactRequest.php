<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, list<string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => __('validation_contact.name_required'),
            'name.max' => __('validation_contact.name_max', ['max' => 255]),
            'email.required' => __('validation_contact.email_required'),
            'email.email' => __('validation_contact.email_email'),
            'email.max' => __('validation_contact.email_max', ['max' => 255]),
            'message.required' => __('validation_contact.message_required'),
            'message.max' => __('validation_contact.message_max', ['max' => 2000]),
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            if ($this->filled('company')) {
                $validator->errors()->add('contact', __('pages.contacts.invalid_request'));
            }
        });
    }
}
