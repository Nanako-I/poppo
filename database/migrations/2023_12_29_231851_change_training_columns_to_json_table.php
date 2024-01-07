<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTrainingColumnsToJsonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('trainings')->delete();
       Schema::table('trainings', function (Blueprint $table) {
           
            
            $table->json('communication')->nullable()->change();
            $table->json('exercise')->nullable()->change();
            $table->json('reading_writing')->nullable()->change();
            $table->json('calculation')->nullable()->change();
            $table->json('homework')->nullable()->change();
            $table->json('shopping')->nullable()->change();
            $table->json('training_other')->nullable()->change();
           
   });
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainings', function (Blueprint $table) {
            //
        });
    }
};
