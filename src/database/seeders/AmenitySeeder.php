<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenities = [
            'テレビ',
            '冷蔵庫',
            '加湿器',
            'シャンプー',
            'ボディーソープ',
            'コンディショナー',
            '歯磨きセット',
            '化粧水',
            '乳液',
            'タオル',
            'バスタオル',
            'WiFi',
            'スリッパ',
            'キッズアメニティ',
        ];

        foreach ($amenities as $amenitiy) {
            DB::table('amenities')->insert([
                'name' => $amenitiy,
            ]);
        }
    }
}
