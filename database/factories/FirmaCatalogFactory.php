<?php

namespace Database\Factories;

use App\Models\FirmaCatalog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FirmaCatalog>
 */
class FirmaCatalogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
        ];
    }
}
