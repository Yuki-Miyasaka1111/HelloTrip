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
            $table->string('facility_scale');  // 施設規模
            $table->string('prefecture');  // 都道府県
            $table->string('catch_copy');  // キャッチコピー
            $table->integer('minimum_price');  // 最低宿泊単価 / 人
            $table->string('postal_code');  // 郵便番号
            $table->string('address_1');  // 住所1
            $table->string('address_2');  // 住所2
            $table->string('address_3');  // 住所3
            $table->text('access');  // アクセス
            $table->time('check_in');  // チェックイン
            $table->time('check_out');  // チェックアウト
            $table->text('parking_information');  // 駐車場情報
            $table->string('monthly_holiday');  // 月定休日
            $table->date('temporary_holiday')->nullable();  // 臨時定休日
            $table->text('other_information');  // その他の情報
            $table->text('other_facility_information');  // その他の設備情報
            $table->text('other_equipment_information');  // その他の備品情報
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn([
                'facility_scale', 'prefecture','catch_copy', 
                'price','minimum_price', 'postal_code', 'address', 'address_1', 'address_2', 
                'address_3', 'access', 'check_in',
                'check_out', 'parking_information', 'monthly_holiday', 
                'temporary_holiday', 'other_information', 'other_facility_information', 
                'other_equipment_information'
            ]);
        });
    }
};
