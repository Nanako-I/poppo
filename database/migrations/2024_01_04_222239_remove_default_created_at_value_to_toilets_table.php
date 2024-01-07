<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


// class ChangeCreatedAtColumnsToTimestampToToiletsTable extends Migration
class RemoveDefaultCreatedAtValueToToiletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('toilets', function (Blueprint $table) {
            $table->dateTime('created_at')->default(null)->change();
        });
        
        // Schema::table('toilets', function (Blueprint $table) {
        //     // $table->timestamps()->change();
        //     $table->timestamp('created_at')->change();
        // });
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
