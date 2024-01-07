<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrineAndBenColumnsToToiletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('toilets', function (Blueprint $table) {
            $table->string('urine')->nullable();
            $table->string('ben')->nullable();
            // $table->timestamp('created_at')->nullable()->change();
            $table->datetime('created_at')->default(now())->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('toilets', function (Blueprint $table) {
            //
        });
    }
};
