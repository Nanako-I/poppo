<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateToTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('times', 'date')) {
            Schema::table('times', function (Blueprint $table) {
                $table->date('date')->default(now())->after('people_id');
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
        if (Schema::hasColumn('times', 'date')) {
            Schema::table('times', function (Blueprint $table) {
                $table->dropColumn('date');
            });
        }
    }
};
