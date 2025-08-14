<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'street' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'zip' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'vat_number' => $this->faker->regexify('[A-Z]{2}[0-9]{11}'),
            'fiscal_code' => $this->faker->regexify('[A-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]'),
            'notes' => $this->faker->optional()->text(),
        ];
    }
}
