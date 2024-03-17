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
        Schema::create('hogoshas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('people_id');
            // onDelete('cascade')は、外部キーの参照先のpeopleテーブルのidのレコードが削除された場合に、このレコードも一緒に削除されるようにする
            $table->foreign('people_id')->references('id')->on('people')->onDelete('cascade');
            $table->string('condition')->nullable();
            $table->dateTime('temperature_created_at')->useCurrent()->nullable(false);
            $table->decimal('temperature', 3, 1);
            $table->dateTime('ben_created_at')->useCurrent()->nullable(false);
            $table->string('ben_condition')->nullable();
            $table->dateTime('urine_created_at')->useCurrent()->nullable(false);
            $table->dateTime('food_created_at')->useCurrent()->nullable(false);
            $table->string('nyuuyoku')->nullable();
            $table->string('oyatsu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hogoshas');
    }
};
