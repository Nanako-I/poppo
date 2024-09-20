<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class MedicalCareNeedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // データベースにデータを挿入
        DB::table('medical_care_needs')->insert([
            ['name' => 'medical_care_majority', 'guard_name' => 'web'],
            ['name' => 'medical_care_minority', 'guard_name' => 'web'],
            ['name' => 'no_medical_care', 'guard_name' => 'web'],
        ]);
        
    }
}
