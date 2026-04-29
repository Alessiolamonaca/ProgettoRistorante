<?php

namespace App\Data;

final readonly class ContactRequestData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $message,
    ) {
    }

    /**
     * @param  array{name: string, email: string, message: string}  $input
     */
    public static function fromValidatedInput(array $input): self
    {
        return new self(
            name: $input['name'],
            email: $input['email'],
            message: $input['message'],
        );
    }
}
