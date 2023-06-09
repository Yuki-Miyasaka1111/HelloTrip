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
        Schema::table('campaigns', function (Blueprint $table) {
            $table->foreign(['client_id'])->references(['id'])->on('clients')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['hotel_id'])->references(['id'])->on('hotels')->onUpdate('NO ACTION')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropForeign('campaigns_client_id_foreign');
            $table->dropForeign('campaigns_hotel_id_foreign');
        });
    }
};
