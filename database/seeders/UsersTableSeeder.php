<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // データの挿入処理を記述
        DB::table('messages')->insert([
            'body' => 'こんにちは',
        ]);
    }
}
