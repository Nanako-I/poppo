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

        // Schema::create('chats', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('conversation_id'); // unsignedBigInteger 型に変更
        //     $table->unsignedBigInteger('user_id'); // メッセージを送信したユーザーのID

        //     $table->string('user_name')->default('noname');
        //     $table->string('user_identifier');
        //     $table->text('message');
        //     $table->string('filename')->nullable();
        //     $table->string('path')->nullable();
        //     $table->timestamps();

        //     // 外部キー制約
        //     $table->foreign('conversation_id')
        //           ->references('id')
        //           ->on('conversations')
        //           ->onDelete('cascade');

        //     $table->foreign('user_id')
        //           ->references('id')
        //           ->on('users')
        //           ->onDelete('cascade');
        // });
         Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('people_id');
            // onDelete('cascade')は、外部キーの参照先のpeopleテーブルのidのレコードが削除された場合に、このレコードも一緒に削除されるようにする
            $table->foreign('people_id')->references('id')->on('people')->onDelete('cascade');

            // $table->bigIncrements('id');
            $table->string('user_name')->default('noname');
            $table->string('user_identifier');
            $table->string('message');
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
            $table->boolean('is_read')->default(false); // 未読の場合は false, 既読は true
        });

        // Schema::create('chats', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('conversation_id');
        //     $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');

        //     $table->unsignedBigInteger('user_id');
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        //     $table->string('user_name')->default('noname');
        //     $table->string('user_identifier');
        //     $table->text('message');
        //     $table->timestamp('created_at')->useCurrent()->nullable();
        //     $table->timestamp('updated_at')->useCurrent()->nullable();
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
};
