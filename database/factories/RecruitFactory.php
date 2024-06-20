<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Prefecture;
use App\Models\Recruit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recruit>
 */
class RecruitFactory extends Factory
{
    protected $model = Recruit::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'company_id' => Company::factory(),
			'prefecture_id' => Prefecture::factory(),
        ];
    }
}
