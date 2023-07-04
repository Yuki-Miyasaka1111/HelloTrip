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
        Schema::table('published_hotel_amenities', function (Blueprint $table) {
            $table->foreign(['amenity_id'])->references(['id'])->on('amenities')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['published_hotel_id'])->references(['id'])->on('hotels')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('published_hotel_amenities', function (Blueprint $table) {
            $table->dropForeign('published_hotel_amenities_amenity_id_foreign');
            $table->dropForeign('published_hotel_amenities_published_hotel_id_foreign');
        });
    }
};
