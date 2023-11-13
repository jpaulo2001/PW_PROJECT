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
        Schema::create('documents_permitions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softdeletes();
            $table->foreignId("permitions_types_id");
            $table->string("types");
        });

        Schema::create('documents_permitions_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softdeletes();
            $table->foreignId("documents_permitions");
            $table->foreignId("documents_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents_permitions');
        Schema::dropIfExists('documents_permitions_types');

    }
};
