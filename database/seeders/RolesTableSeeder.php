<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // staff ロールを挿入
        Role::create([
            'name' => 'staff'
        ]);

        // family ロールを挿入
        Role::create([
            'name' => 'family'
        ]);
    }
}
