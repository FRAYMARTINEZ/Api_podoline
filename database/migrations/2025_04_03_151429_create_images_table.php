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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('original_name')->nullable();
            $table->string('filename');
            $table->string('path');
            $table->string('full_url');
            $table->string('mime_type');
            $table->integer('size');
            $table->integer('width');
            $table->integer('height');
            $table->string('model_type')->nullable();  // Para relación polimórfica
            $table->unsignedBigInteger('model_id')->nullable();  // Para relación polimórfica
            $table->timestamps();
            
            $table->index(['model_type', 'model_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
