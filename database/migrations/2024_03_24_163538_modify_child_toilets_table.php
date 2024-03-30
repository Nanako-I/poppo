<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('child_toilets', function (Blueprint $table) {
        $table->dropColumn('toilet_created_at'); // 'toilet_created_at'カラムを削除
        $table->timestamp('urine_created_at')->after('people_id')->nullable(); // 'urine_created_at'カラムを追加
        $table->timestamp('ben_created_at')->after('urine_created_at')->nullable(); // 'ben_created_at'カラムを追加
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('child_toilets', function (Blueprint $table) {
            //
        });
    }
};
