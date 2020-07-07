<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DangKySach extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dang_ky_sach', function (Blueprint $table) {
            $table->increments('ma_dang_ky');
            $table->integer('ma_sinh_vien')->unsigned();
            $table->integer('ma_sach')->unsigned();
            $table->tinyInteger('tinh_trang_nhan_sach')->unsigned();
            $table->date('ngay_dang_ky');
            $table->date('ngay_nhan_sach');
            $table->foreign('ma_sinh_vien')->references('ma_sinh_vien')->on('sinh_vien');
            $table->foreign('ma_sach')->references('ma_sach')->on('sach');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dang_ky_sach');
    }
}
