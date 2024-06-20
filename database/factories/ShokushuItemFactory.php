<?php

namespace Database\Factories;

use App\Models\ShokushuItem;
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
            'name' => $this->faker->address(),
            'snum' => random_int(10, 99999),
        ];
    }
}
