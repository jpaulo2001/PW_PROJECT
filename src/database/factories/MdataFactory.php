<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mdata>
 */
class MdataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $commonDocumentFormats = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'];
        $commonDocumentTypes = ['Contract', 'Report', 'Proposal', 'Presentation', 'Spreadsheet', 'Article'];

        // Generate a random size in bytes (between 100 KB and 10 MB for example)
        $sizeInBytes = $this->faker->numberBetween(100 * 1024, 10 * 1024 * 1024);
        // Convert the size to kilobytes
        $sizeInKB = round($sizeInBytes / 1024);

        return [
            'doc_name' => $this->faker->unique()->word,
            'size' => $sizeInKB,
            'type' => $this->faker->randomElement($commonDocumentTypes),
            'format' => $this->faker->randomElement($commonDocumentFormats),
        ];
    }
}
