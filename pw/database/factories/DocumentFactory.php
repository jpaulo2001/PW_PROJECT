<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'users_id' => fake()->numberBetween(1, 50),
            'metadata_id' => fake()->numberBetween(1, 200),
            'permitions_id' => fake()->numberBetween(1, 200),
            'name' => fake()->name(),
            'size' => Str::random(16),
            'format' => fake()->name()
        ];
    }
}