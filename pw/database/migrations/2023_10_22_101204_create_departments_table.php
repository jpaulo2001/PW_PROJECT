<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->strings("name");
            $table->strings("code");
            $table->foreign("departmentsTypes_id");
            $table->softdeletes();
        });

        Schema::create('departmentsTypes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("types");
            $table->softdeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
        Schema::dropIfExists('departmentsTypes');

    }
};
