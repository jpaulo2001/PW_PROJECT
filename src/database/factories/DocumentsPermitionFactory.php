<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentPermition>
 */
class DocumentsPermitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static $index = 0;
    protected static $types = [
        'Read',
        'Edit',
        'Delete',
    ];


    public function definition(): array
    {
        if (self::$index === count(self::$types)) {
            self::$index = 0;
        }
        return [
            'permitions_types_id' => fake()->numberBetween(1, 3),
            'types' => self::$types[self::$index++],
        ];
    }
}
