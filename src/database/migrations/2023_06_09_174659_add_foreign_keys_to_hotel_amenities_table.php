<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotel_amenities', function (Blueprint $table) {
            $table->foreign(['amenity_id'])->references(['id'])->on('amenities')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['hotel_id'])->references(['id'])->on('hotels')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotel_amenities', function (Blueprint $table) {
            $table->dropForeign('hotel_amenities_amenity_id_foreign');
            $table->dropForeign('hotel_amenities_hotel_id_foreign');
        });
    }
};
