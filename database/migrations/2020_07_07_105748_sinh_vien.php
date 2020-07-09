<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SinhVien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinh_vien', function (Blueprint $table) {
            $table->increments('ma_sinh_vien');
            $table->string('ten_sinh_vien', 100);
            $table->date('ngay_sinh');
            $table->string('email', 100);
            $table->string('sdt', 10);
            $table->string('dia_chi', 100);
            $table->integer('ma_lop')->unsigned();
            $table->foreign('ma_lop')->references('ma_lop')->on('lop');
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
        Schema::dropIfExists('sinh_vien');
    }
}
