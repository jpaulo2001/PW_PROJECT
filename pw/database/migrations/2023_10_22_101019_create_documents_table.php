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
            $table->foreignId("users_id");
            $table->foreignId("permitions_id");
        });

        Schema::create('document_metadata', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softdeletes();
            $table->foreignId("metadata_id");
            $table->foreignId("documents_id");
            $table->string("content");
        });
  
        Schema::create('metadata', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name");         
            $table->string("format");
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
        Schema::dropIfExists('document_metadata');
        

    }
};
