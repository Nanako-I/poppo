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
        Schema::table('bloodpressures', function (Blueprint $table) {
            $table->integer('pulse')->after('min_blood')->nullable(); // 例: 'other_column' の後ろに 'pulse' カラムを追加
            $table->integer('spo2')->after('pulse')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bloodpressures', function (Blueprint $table) {
            //
        });
    }
};
