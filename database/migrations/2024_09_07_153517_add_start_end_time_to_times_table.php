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
        Schema::table('times', function (Blueprint $table) {
            if (!Schema::hasColumn('times', 'start_time')) {
                $table->time('start_time')->default('00:00')->after('date');
            }

            if (!Schema::hasColumn('times', 'end_time')) {
                $table->time('end_time')->default('00:00')->after('start_time');
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
        Schema::table('times', function (Blueprint $table) {
            if (Schema::hasColumn('times', 'start_time')) {
                $table->dropColumn('start_time');
            }

            if (Schema::hasColumn('times', 'end_time')) {
                $table->dropColumn('end_time');
            }
        });
    }
};
