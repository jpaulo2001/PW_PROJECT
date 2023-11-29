<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Department;
use App\Models\DocumentMdata;
use App\Models\DocumentPermitionType;
use App\Models\Mdata;
use App\Models\User;
use App\Models\Historic;
use App\Models\Document;
use App\Models\DocumentPermition;
use App\Models\UserType;
use App\Models\UserTypePermition;
use Database\Factories\DocumentPermitionTypeFactory;
use Database\Factories\MetadataFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        if (App::environment() == 'local') {
            User::factory(500)->create();
            Department::factory(8)->create();
            Document::factory(500)->create();
            Historic::factory(500)->create();
            DocumentPermition::factory(3)->create();
            DocumentPermitionType::factory(500)->create();
            UserTypePermition::factory(5)->create();
            UserType::factory(500)->create();
            Mdata::factory(50)->create();
            DocumentMdata::factory(50)->create();
        }

    }
}
