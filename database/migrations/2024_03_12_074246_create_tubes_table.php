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
        Schema::create('tubes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('people_id');
            // onDelete('cascade')は、外部キーの参照先のpeopleテーブルのidのレコードが削除された場合に、このレコードも一緒に削除されるようにする
            $table->foreign('people_id')->references('id')->on('people')->onDelete('cascade');
            $table->unsignedBigInteger('user_id_tube')->nullable();
            $table->dateTime('created_at_tube')->useCurrent()->nullable(false);
            $table->string('tube')->nullable();
            $table->string('tube_bikou')->nullable();
            
            $table->unsignedBigInteger('user_id_medicine')->nullable();
            $table->dateTime('created_at_medicine')->useCurrent()->nullable(false);
            $table->string('medicine')->nullable();
            $table->string('medicine_bikou')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tubes');
    }
};
