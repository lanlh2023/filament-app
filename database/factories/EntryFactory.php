<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Entry;
use App\Models\Recruit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Apply\Models\Entry>
 */
class EntryFactory extends Factory
{
    protected $model = Entry::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'company_id' => Company::factory(),
            'recruit_id' => Recruit::factory(),
        ];
    }
}
