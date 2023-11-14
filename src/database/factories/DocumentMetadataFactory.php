<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\Metadata;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentMetadata>
 */
class DocumentMetadataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'metadata_id' => $this->faker->numberBetween(1, 50),
            'documents_id' => $this->faker->numberBetween(1, 500),
            'content' => $this->faker->text,
            'value' => $this->faker->numberBetween(1, 20),
        ];
    }
}
