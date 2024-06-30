<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipToFaciltyStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facilty_staffs', function (Blueprint $table) {
            $table->string('relationship')->nullable();  // `bikou` カラムを追加。文字列型で、NULLを許容。
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facilty_staffs', function (Blueprint $table) {
            //
        });
    }
};
