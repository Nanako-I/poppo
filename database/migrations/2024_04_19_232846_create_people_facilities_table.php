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
        Schema::create('people_facilities', function (Blueprint $table) {
            $table->id(); // 自動生成されるプライマリキー
            $table->unsignedBigInteger('people_id'); // peopleテーブルへの外部キー
            $table->unsignedBigInteger('facility_id'); // facilityテーブルへの外部キー

            // 外部キー制約を追加
            $table->foreign('people_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');

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
        Schema::dropIfExists('people_facilities');
    }
};
