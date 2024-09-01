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
        Schema::create('custom_ids', function (Blueprint $table) {
            $table->id();
            $table->string('custom_id');
            $table->unsignedBigInteger('facility_id')->nullable();
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
            $table->timestamps();

            // 複合ユニークインデックスの追加（同じfacility_idをもつデータはユニークなcustom_idをもっている。同じcustom_idを登録させない）
            $table->unique(['custom_id', 'facility_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('custom_ids');
    }
};
