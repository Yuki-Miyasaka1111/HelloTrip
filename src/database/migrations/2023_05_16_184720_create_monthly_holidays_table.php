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
        Schema::create('monthly_holidays', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_id'); // Assuming the hotel table has an id column
            $table->integer('week');
            $table->string('day');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('hotel_id')
                  ->references('id')
                  ->on('hotels') // Assuming the hotel table is named 'hotels'
                  ->onDelete('cascade');
        });

        // You might also want to drop the old column
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('monthly_holiday');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_holidays');

        // You might want to add back the old column in the down method
        Schema::table('hotels', function (Blueprint $table) {
            $table->string('monthly_holiday')->nullable();
        });
    }
};
