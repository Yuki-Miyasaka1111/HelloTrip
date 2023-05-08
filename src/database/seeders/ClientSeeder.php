<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->insert([
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'client_name'=> '株式会社ほげほげ',
                'manager_name'=> '田中太郎',
                'manager_department'=> '営業部長',
                'manager_phone_number'=> '0123456789',
                'client_email'=> 'client01@gmail.com',
                'client_password'=> 'password',
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'client_name'=> '株式会社ほげほげ',
                'manager_name'=> '田中花子',
                'manager_department'=> '営業部長',
                'manager_phone_number'=> '0123456789',
                'client_email'=> 'client02@gmail.com',
                'client_password'=> 'password',
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'client_name'=> '株式会社ほげほげ',
                'manager_name'=> '田中次郎',
                'manager_department'=> '営業部長',
                'manager_phone_number'=> '0123456789',
                'client_email'=> 'client03@gmail.com',
                'client_password'=> 'password',
            ],
        ]);
    }
}
