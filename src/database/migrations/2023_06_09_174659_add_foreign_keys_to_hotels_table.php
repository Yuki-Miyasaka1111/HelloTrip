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
        Schema::table('hotels', function (Blueprint $table) {
            $table->foreign(['area_id'])->references(['id'])->on('areas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['prefecture_id'])->references(['id'])->on('prefectures')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropForeign('hotels_area_id_foreign');
            $table->dropForeign('hotels_prefecture_id_foreign');
        });
    }
};
