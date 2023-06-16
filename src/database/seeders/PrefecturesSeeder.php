<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrefecturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prefectures')->insert([
            ['created_at' => now(), 'updated_at' => null, 'name'=> '北海道'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '青森県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '岩手県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '宮城県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '秋田県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '山形県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '福島県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '茨城県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '栃木県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '群馬県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '埼玉県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '千葉県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '東京都'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '神奈川県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '新潟県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '富山県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '石川県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '福井県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '山梨県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '長野県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '岐阜県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '静岡県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '愛知県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '三重県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '滋賀県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '京都府'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '大阪府'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '兵庫県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '奈良県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '和歌山県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '鳥取県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '島根県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '岡山県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '広島県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '山口県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '徳島県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '香川県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '愛媛県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '高知県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '福岡県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '佐賀県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '長崎県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '熊本県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '大分県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '宮崎県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '鹿児島県'],
            ['created_at' => now(), 'updated_at' => null, 'name'=> '沖縄県'],
        ]);
    }
}
