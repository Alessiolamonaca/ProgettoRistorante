<?php

namespace Tests\Feature;

use Tests\TestCase;

class SecurityHeadersTest extends TestCase
{
    public function test_public_pages_include_security_headers(): void
    {
        $response = $this->get('/it');

        $response->assertOk();
        $response->assertHeader('Content-Security-Policy');
        $response->assertHeader('Permissions-Policy');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
    }
}
