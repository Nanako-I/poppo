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
        // テーブルが存在しない場合にのみ作成
        if (!Schema::hasTable('people_users')) {
            Schema::create('people_users', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('person_id');
                $table->unsignedBigInteger('user_id');
                $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // テーブルが存在する場合にのみ削除
        if (Schema::hasTable('people_users')) {
            Schema::dropIfExists('people_users');
        }
    }
};
