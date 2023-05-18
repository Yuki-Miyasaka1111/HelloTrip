<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            if (!Schema::hasColumn('campaigns', 'hotel_id')) {
                $table->unsignedBigInteger('hotel_id')->nullable();
                $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('set null');
            }

            if (!Schema::hasColumn('campaigns', 'immediate_publication_set')) {
                $table->smallInteger('immediate_publication_set')->default(0);
            }

            if (!Schema::hasColumn('campaigns', 'publication_date')) {
                $table->dateTime('publication_date')->nullable();
            }

            if (!Schema::hasColumn('campaigns', 'end_publication_date')) {
                $table->dateTime('end_publication_date')->nullable();
            }

            if (!Schema::hasColumn('campaigns', 'publish_status')) {
                $table->smallInteger('publish_status')->default(1);
            }

            if (!Schema::hasColumn('campaigns', 'image_url')) {
                $table->string('image_url')->nullable();
            }

            if (!Schema::hasColumn('campaigns', 'campaign_start_date')) {
                $table->dateTime('campaign_start_date')->nullable();
            }

            if (!Schema::hasColumn('campaigns', 'campaign_end_date')) {
                $table->dateTime('campaign_end_date')->nullable();
            }

            if (!Schema::hasColumn('campaigns', 'content')) {
                $table->text('content')->nullable();
            }
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
            $table->dropForeign(['hotel_id']);
            $table->dropColumn([
                'hotel_id',
                'immediate_publication_set',
                'publication_date',
                'end_publication_date',
                'publish_status',
                'image_url',
                'campaign_start_date',
                'campaign_end_date',
                'content'
            ]);
        });
    }
}
