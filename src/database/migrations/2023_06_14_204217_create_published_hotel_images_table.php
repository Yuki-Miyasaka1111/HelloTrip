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
        Schema::create('published_hotel_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('published_hotel_id')->index();
            $table->string('filename');
            $table->string('path');
            $table->timestamps();
        
            $table->foreign('published_hotel_id')
                ->references('id')
                ->on('published_hotels')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('published_hotel_images');
    }
};
