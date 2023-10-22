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
        Schema::create('historics', function (Blueprint $table) {
            $table->id();
            $table->foreignId("users_id")->nullable()->constrained();
            $table->foreignId("documents_id")->nullable()->constrained();
            $table->timestamps();
            $table->date();
            $table->softdeletes();
            $table->string("body");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historics');
    }
};
