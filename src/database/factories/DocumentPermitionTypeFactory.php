<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentPermitionType>
 */
class DocumentPermitionTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'document_permition_id' => fake()->numberBetween(1,3),
            'document_id' => fake()->numberBetween(1,500),
        ];
    }
}
