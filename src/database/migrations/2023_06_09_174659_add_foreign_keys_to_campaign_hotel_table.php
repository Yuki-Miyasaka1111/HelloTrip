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
        Schema::table('campaign_hotel', function (Blueprint $table) {
            $table->foreign(['campaign_id'])->references(['id'])->on('campaigns')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
        Schema::table('campaign_hotel', function (Blueprint $table) {
            $table->dropForeign('campaign_hotel_campaign_id_foreign');
            $table->dropForeign('campaign_hotel_hotel_id_foreign');
        });
    }
};
