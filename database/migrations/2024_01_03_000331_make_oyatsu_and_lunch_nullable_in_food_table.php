<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeOyatsuAndLunchNullableInFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('food', function (Blueprint $table) {
        
        $table->string('lunch')->nullable()->change();
        $table->string('lunch_bikou')->nullable()->change();
        $table->string('oyatsu')->nullable()->change();
        $table->string('oyatsu_bikou')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('food', function (Blueprint $table) {
            //
        });
    }
};
