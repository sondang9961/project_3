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
            $table->integer('ma_chuyen_nganh')->unsigned();
            $table->foreign('ma_chuyen_nganh')->references('ma_chuyen_nganh')->on('chuyen_nganh');
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
        Schema::dropIfExists('mon_hoc');
    }
}
