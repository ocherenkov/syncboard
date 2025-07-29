<?php

namespace Database\Factories;

use App\Enums\OrderSourceEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LinkerOrder>
 */
class LinkerOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'source' => $this->faker->randomElement(OrderSourceEnum::cases()),
            'total' => 0,
            'date' => $this->faker->dateTimeBetween('-30 days'),
        ];
    }
}
