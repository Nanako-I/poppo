<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   
    public function up()
    {
        
          
        // Schema::table('times', function (Blueprint $table) {
        //     $table->date('date')->after('end_time '); // 任意の位置に追加できます
        // });
        
        Schema::table('times', function (Blueprint $table) {
            $table->time('start_time')->default('00:00')->change();
            $table->time('end_time')->default('00:00')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
