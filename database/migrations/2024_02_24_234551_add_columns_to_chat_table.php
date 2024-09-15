<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// return new class extends Migration
class AddColumnsToChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chats', function (Blueprint $table) {
            if (!Schema::hasColumn('chats', 'send')) {
                $table->string('send')->nullable()->after('user_identifier');
            }
            if (!Schema::hasColumn('chats', 'receive')) {
                $table->string('receive')->nullable()->after('send');
            }
            if (!Schema::hasColumn('chats', 'filename')) {
                $table->string('filename')->nullable()->after('message');
            }
            if (!Schema::hasColumn('chats', 'path')) {
                $table->string('path')->nullable()->after('filename');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chats', function (Blueprint $table) {
            if (Schema::hasColumn('chats', 'send')) {
                $table->dropColumn('send');
            }
            if (Schema::hasColumn('chats', 'receive')) {
                $table->dropColumn('receive');
            }
            if (Schema::hasColumn('chats', 'filename')) {
                $table->dropColumn('filename');
            }
            if (Schema::hasColumn('chats', 'path')) {
                $table->dropColumn('path');
            }
        });
    }
};
