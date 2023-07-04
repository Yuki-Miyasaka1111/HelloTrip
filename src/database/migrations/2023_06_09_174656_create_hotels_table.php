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
        Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('thumbnail');
            $table->string('name');
            $table->string('concept')->nullable();
            $table->string('phone_number')->nullable();
            $table->unsignedBigInteger('prefecture_id')->nullable()->index('hotels_prefecture_id_foreign');
            $table->unsignedBigInteger('area_id')->nullable()->index('hotels_area_id_foreign');
            $table->bigInteger('category_id')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('facility_scale')->nullable();
            $table->string('catch_copy')->nullable();
            $table->integer('minimum_price')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('address_3')->nullable();
            $table->text('access')->nullable();
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->text('parking_information')->nullable();
            $table->date('temporary_holiday')->nullable();
            $table->text('other_information')->nullable();
            $table->text('other_facility_information')->nullable();
            $table->text('other_equipment_information')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotels');
    }
};
