<?php

namespace Database\Factories\Apply;

use Domain\Apply\Models\ShokushuItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShokushuItemFactory extends Factory
{
	protected $model = ShokushuItem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(rand(3, 6), true),
            'snum' => random_int(10, 99999),
        ];
    }
}
