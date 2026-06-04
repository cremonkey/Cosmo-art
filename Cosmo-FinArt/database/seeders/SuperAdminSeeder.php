<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $isProduction = app()->environment('production');
        $allowInProduction = filter_var(env('ALLOW_PRODUCTION_ADMIN_SEED', false), FILTER_VALIDATE_BOOL);

        if ($isProduction && ! $allowInProduction) {
            $this->command?->warn('Skipping SuperAdminSeeder in production. Set ALLOW_PRODUCTION_ADMIN_SEED=true to allow.');

            return;
        }

        $email = env('SEED_SUPER_ADMIN_EMAIL');
        $password = env('SEED_SUPER_ADMIN_PASSWORD');
        $name = env('SEED_SUPER_ADMIN_NAME', 'Super Admin');

        $tonkerEmail = env('SEED_TONKER_ADMIN_EMAIL');
        $tonkerPassword = env('SEED_TONKER_ADMIN_PASSWORD');
        $tonkerName = env('SEED_TONKER_ADMIN_NAME', 'Tonker Admin');

        // Safe local fallback only. Production requires explicit credentials.
        if (! $email && ! $isProduction) {
            $email = 'admin@cosmofinart.local';
        }

        if (! $password && ! $isProduction) {
            $password = 'ChangeMe123!';
        }

        if (! $tonkerEmail && ! $isProduction) {
            $tonkerEmail = 'tonker@cosmofinart.local';
        }

        if (! $tonkerPassword && ! $isProduction) {
            $tonkerPassword = 'TonkerAdmin123!';
        }

        if (! $email || ! $password) {
            $this->command?->warn('Super admin was not seeded. Set SEED_SUPER_ADMIN_EMAIL and SEED_SUPER_ADMIN_PASSWORD.');
        } else {
            $this->seedAdminUser($email, $password, $name);
        }

        if (! $tonkerEmail || ! $tonkerPassword) {
            $this->command?->warn('Tonker admin was not seeded. Set SEED_TONKER_ADMIN_EMAIL and SEED_TONKER_ADMIN_PASSWORD.');

            return;
        }

        $this->seedAdminUser($tonkerEmail, $tonkerPassword, $tonkerName);
    }

    private function seedAdminUser(string $email, string $password, string $name): void
    {
        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
