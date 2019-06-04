<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sach extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sach', function (Blueprint $table) {
            $table->increments('ma_sach');
            $table->string('ten_sach', 100);
            $table->date('ngay_nhap_sach');
            $table->integer('so_luong_nhap')->unsigned();
            $table->date('ngay_het_han');
            $table->integer('ma_mon_hoc')->unsigned();
            $table->foreign('ma_mon_hoc')->references('ma_mon_hoc')->on('mon_hoc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sach');
    }
}
