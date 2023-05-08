<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class HotelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hotels')->insert([
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'name'=> 'ホテル１',
                'price'=> '10000',
                'category_id'=> '1',
                'region_id'=> '1',
                'phone_number'=> '0123456789',
                'address'=> '神奈川県足柄下郡箱根町',
                'url'=> 'https://www.google.com/',
                'description'=> 'ゆったりとお風呂に浸かり会席料理を楽しむ。別荘感覚で過ごしBBQの夕食まで静かな森の中で過ごす',
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'name'=> 'ホテル2',
                'price'=> '20000',
                'category_id'=> '2',
                'region_id'=> '2',
                'phone_number'=> '0123456789',
                'address'=> '神奈川県足柄下郡箱根町',
                'url'=> 'https://www.google.com/',
                'description'=> '飛騨高山のカルチャーと共に生まれた新しい発見を探索する拠点になる',
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'name'=> 'ホテル3',
                'price'=> '30000',
                'category_id'=> '3',
                'region_id'=> '3',
                'phone_number'=> '0123456789',
                'address'=> '神奈川県足柄下郡箱根町',
                'url'=> 'https://www.google.com/',
                'description'=> 'GOOD LOCAL"と出会う旅へ',
            ],
        ]);
    }
}
