<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLichlamviec extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lich', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idcoso');
            $table->string('thu', 20);
            $table->integer('soluongkhach');
            $table->time('giobatdau');
            $table->time('gioketthuc');
            $table->boolean('type');
            $table->string('ghichu', 100);
            $table->foreign('idcoso')->references('id')->on('coso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lich');
    }
}
