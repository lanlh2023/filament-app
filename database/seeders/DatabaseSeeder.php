<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\Prefecture;
use App\Models\Recruit;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
		Prefecture::factory()
			->has(Company::factory()->count(10))
			->has(Recruit::factory()->count(100))
			->count(5)
			->create();

        // $company = Company::factory()->count(500000)->create();
		// Recruit::factory()->for(Company::factory(), 'company')->count(100)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}