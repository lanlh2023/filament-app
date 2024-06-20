<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Database\Seeders\Apply\ApplySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    private const USER_MAIL = 'test@example.com';

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => self::USER_MAIL,
        ]);

        $this->call([
            ApplySeeder::class
        ]);
    }

    protected function testUser(): User
    {
        return User::whereEmail(self::USER_MAIL)->firstOrFail();

    }
}
