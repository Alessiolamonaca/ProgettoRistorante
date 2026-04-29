<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(MenuSeeder::class);
        $this->seedAdminUser();
    }

    private function seedAdminUser(): void
    {
        $adminName = config('admin.name', 'Administrator');
        $adminEmail = config('admin.email');
        $adminPassword = config('admin.password');

        if (app()->environment(['local', 'testing'])) {
            $adminName = is_string($adminName) && $adminName !== '' ? $adminName : 'Test Admin';
            $adminEmail = is_string($adminEmail) && $adminEmail !== '' ? $adminEmail : 'test@example.com';
            $adminPassword = is_string($adminPassword) && $adminPassword !== '' ? $adminPassword : 'password';
        }

        if (! is_string($adminEmail) || $adminEmail === '' || ! is_string($adminPassword) || $adminPassword === '') {
            return;
        }

        User::query()->updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => $adminName,
                'password' => $adminPassword,
                'email_verified_at' => now(),
            ]
        );
    }
}
