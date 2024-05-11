<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropRelationshipColumnFromPeopleFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('people_families', function (Blueprint $table) {
            $table->dropColumn('relationship');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
    {
        Schema::table('people_families', function (Blueprint $table) {
            $table->string('relationship')->nullable();
        });
    }
};
