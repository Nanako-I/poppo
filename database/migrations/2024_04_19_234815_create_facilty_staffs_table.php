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
        Schema::create('facilty_staffs', function (Blueprint $table)
         {
            $table->id(); // 自動生成されるプライマリキー
            $table->unsignedBigInteger('facility_id'); // peopleテーブルへの外部キー
            $table->unsignedBigInteger('staff_id'); // usersテーブルへの外部キー(usersテーブルの中からuser_rolesテーブルでrole_idが1（staff）と指定された人物)

            // 外部キー制約を追加
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
            // $table->foreign('staff_id')->references('id')->on('facilities')->onDelete('cascade');

            $table->timestamps(); // created_at と updated_at のタイムスタンプ
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facilty_staffs');
    }
};
