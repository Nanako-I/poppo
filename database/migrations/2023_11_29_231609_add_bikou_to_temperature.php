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
        Schema::table('temperature', function (Blueprint $table) {
          $table->string('bikou')->after('temperature')->nullable(); // 例: 'temperature' の後ろに 'bikou' カラムを追加/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temperature', function (Blueprint $table) {
            //
        });
    }
};
