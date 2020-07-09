<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Lop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lop', function (Blueprint $table) {
            $table->increments('ma_lop');
            $table->string('ten_lop', 20);
            $table->integer('ma_khoa_hoc')->unsigned();
            $table->foreign('ma_khoa_hoc')->references('ma_khoa_hoc')->on('khoa_hoc');
            $table->integer('ma_chuyen_nganh')->unsigned();
            $table->foreign('ma_chuyen_nganh')->references('ma_chuyen_nganh')->on('chuyen_nganh');
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lop');
    }
}
