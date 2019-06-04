<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MonHoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mon_hoc', function (Blueprint $table) {
            $table->increments('ma_mon_hoc');
            $table->string('ten_mon_hoc', 100);
            $table->integer('ma_khoa_hoc')->unsigned();
            $table->foreign('ma_khoa_hoc')->references('ma_khoa_hoc')->on('khoa_hoc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mon_hoc');
    }
}
