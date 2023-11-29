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

        Schema::create('mdatas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softdeletes();
            $table->string("doc_name");
            $table->string("size");
            $table->string("type");
            $table->string("format");
        });

        Schema::create('document_mdatas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softdeletes();
            $table->foreignId("mdata_id")->constrained();
            $table->foreignId("document_id")->constrained();
            $table->string("content");
            $table->integer("value");
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mdatas');
        Schema::dropIfExists('document_mdata');
    }
};
