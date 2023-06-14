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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->unsignedBigInteger('client_id')->index('campaigns_client_id_foreign');
            $table->timestamps();
            $table->unsignedBigInteger('hotel_id')->nullable()->index('campaigns_hotel_id_foreign');
            $table->boolean('immediate_publication_set')->nullable()->default(false);
            $table->dateTime('publication_date')->nullable();
            $table->boolean('end_publication_set')->nullable();
            $table->dateTime('end_publication_date')->nullable();
            $table->boolean('publish_status')->nullable()->default(false);
            $table->string('image_url')->nullable();
            $table->dateTime('campaign_start_date')->nullable();
            $table->dateTime('campaign_end_date')->nullable();
            $table->text('content')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
};
