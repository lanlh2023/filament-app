<?php

namespace Database\Factories;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recruit>
 */
class RecruitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
		$date = Carbon::now();
        return [
			'name' => $this->faker->name(),
			'company_id' => Company::factory(),
			'start_date' => $date,
			'end_date' => $date->addDays(30)
        ];
    }
}
