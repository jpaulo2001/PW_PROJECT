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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softdeletes();
            $table->foreignId("users_id")->nullable()->constrained();
            $table->foreignId("metadata_id")->nullable()->constrained();
            $table->foreignId("permitions_id")->nullable()->constrained();
        });




        Schema::create('metadata', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->strings("name");
            $table->strings("size");
            $table->strings("format");
            $table->softdeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
        Schema::dropIfExists('metadata');

    }
};
