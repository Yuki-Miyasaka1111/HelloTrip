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
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('region_id');
            $table->unsignedBigInteger('prefecture_id')->nullable()->after('phone_number');
            $table->unsignedBigInteger('area_id')->nullable()->after('prefecture_id');
            // Assuming 'prefectures' and 'areas' are the names of your tables
            $table->foreign('prefecture_id')->references('id')->on('prefectures');
            $table->foreign('area_id')->references('id')->on('areas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->unsignedBigInteger('region_id');
            $table->dropForeign(['prefecture_id']);
            $table->dropForeign(['area_id']);
            $table->dropColumn(['prefecture_id', 'area_id']);
        });
    }
};
