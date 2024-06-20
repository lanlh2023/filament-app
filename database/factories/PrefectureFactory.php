<?php

namespace Database\Factories;

use App\Models\Prefecture;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prefecture>
 */
class PrefectureFactory extends Factory
{
    protected $model = Prefecture::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'area_name' => $this->faker->address(),
            'name' => $this->faker->address(),
        ];
    }
}
