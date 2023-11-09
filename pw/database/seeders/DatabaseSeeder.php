<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Department;
use App\Models\Document;
use App\Models\Historic;
use App\Models\Metadata;
use App\Models\Permition;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */


    public function run(): void{
   
        if (App::environment() == 'local') {
            //UserTypes::factory(100)->create();
            //Department::factory(25)->create();
            //Document::factory(500)->create();
            //Historic::factory(500)->create();
            //Metadata::factory(100)->create();
            //Permition::factory(100)->create();
        }
            
    }
    
}