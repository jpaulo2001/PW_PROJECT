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
        Schema::create('users_types_permitions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('type');
        });

        Schema::create('users_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_types_permitions_id')->constrained();
            $table->foreignId('users_id')->constrained();
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_types_permitions');
        Schema::dropIfExists('users_types');
    }
};
