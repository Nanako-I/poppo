<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePeopleUsersToPeopleFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 'people_users' テーブルが存在し、'people_families' テーブルが存在しない場合にリネーム
        if (Schema::hasTable('people_users') && !Schema::hasTable('people_families')) {
            Schema::rename('people_users', 'people_families');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 'people_families' テーブルが存在し、'people_users' テーブルが存在しない場合にリネーム
        if (Schema::hasTable('people_families') && !Schema::hasTable('people_users')) {
            Schema::rename('people_families', 'people_users');
        };
    }
};
