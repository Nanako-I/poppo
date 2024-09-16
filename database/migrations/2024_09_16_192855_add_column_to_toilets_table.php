<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToToiletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 'path' カラムが存在しない場合にのみ追加
        if (!Schema::hasColumn('toilets', 'path')) {
            Schema::table('toilets', function (Blueprint $table) {
                $table->string('path')->after('filename')->nullable();
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
        // 'path' カラムが存在する場合のみ削除
        if (Schema::hasColumn('toilets', 'path')) {
            Schema::table('toilets', function (Blueprint $table) {
                $table->dropColumn('path');
            });
        }
    }
}
