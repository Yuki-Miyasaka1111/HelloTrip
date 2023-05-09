<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            'レストラン',
            '宴会場',
            '会議室',
            'プール',
            '大浴場',
            'サウナ',
            'スパサービス',
            'マッサージサービス',
            '宅急便',
            'クリーニングサービス',
            '自動販売機',
            'WiFi',
            'コインランドリー（有料）',
            'コインランドリー（無料）',
        ];

        foreach ($facilities as $facility) {
            DB::table('facilities')->insert([
                'name' => $facility,
            ]);
        }
    }
}
