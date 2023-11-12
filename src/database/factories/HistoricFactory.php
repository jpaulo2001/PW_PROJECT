<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Historic>
 */
class HistoricFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'documents_id' => fake()->numberBetween(1, 500),
            'date' => fake()->dateTime(),
            'body' => fake()->text,
        ];
    }
}
