<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GiaoVu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giao_vu', function (Blueprint $table) {
            $table->increments('ma_giao_vu');
            $table->string('username', 100);
            $table->string('password', 100);
            $table->string('ten_giao_vu', 100);
            $table->string('email', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('giao_vu');
    }
}
