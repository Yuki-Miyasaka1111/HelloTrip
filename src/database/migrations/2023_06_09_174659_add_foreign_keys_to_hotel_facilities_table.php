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
        Schema::table('hotel_facilities', function (Blueprint $table) {
            $table->foreign(['facility_id'])->references(['id'])->on('facilities')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
        Schema::table('hotel_facilities', function (Blueprint $table) {
            $table->dropForeign('hotel_facilities_facility_id_foreign');
            $table->dropForeign('hotel_facilities_hotel_id_foreign');
        });
    }
};
