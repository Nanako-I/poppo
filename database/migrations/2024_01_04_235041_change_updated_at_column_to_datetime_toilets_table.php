<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUpdatedAtColumnToDatetimeToiletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('toilets', function (Blueprint $table) {
            // データ型を変更し、デフォルト値をNULLに設定
            $table->dateTime('updated_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datetime_toilets', function (Blueprint $table) {
            //
        });
    }
};
