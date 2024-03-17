<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToKyuuinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kyuuins', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id')->nullable();
            
            // 外部キー制約を追加する場合は以下のように記述します
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kyuuins', function (Blueprint $table) {
            //
        });
    }
};
