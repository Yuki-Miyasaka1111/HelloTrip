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
        Schema::table('campaign_images', function (Blueprint $table) {
            $table->foreign(['campaign_id'])->references(['id'])->on('campaigns')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaign_images', function (Blueprint $table) {
            $table->dropForeign('campaign_images_campaign_id_foreign');
        });
    }
};
