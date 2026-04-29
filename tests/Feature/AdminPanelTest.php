<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_local_seeded_admin_can_access_the_admin_panel(): void
    {
        $this->seed();

        $admin = User::query()->where('email', 'test@example.com')->firstOrFail();

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertOk();
    }
}
