<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('chats')) {
        Schema::table('chats', function (Blueprint $table) {
            if (!Schema::hasColumn('chats', 'send')) {
            $table->string('send')->after('user_identifier')->nullable();
        }
        if (!Schema::hasColumn('chats', 'receive')) {
            $table->string('receive')->after('send')->nullable();
        }
        if (!Schema::hasColumn('chats', 'filename')) {
            $table->string('filename')->after('message')->nullable();
        }
        if (!Schema::hasColumn('chats', 'path')) {
            $table->string('path')->after('filename')->nullable();
        }
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
        Schema::table('chats', function (Blueprint $table) {
            //
        });
    }
};
