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
        Schema::create('passcodes', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('passcode');
            $table->timestamp('expires_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('passcodes');
    }
};
