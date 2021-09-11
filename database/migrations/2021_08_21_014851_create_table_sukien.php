<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSukien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sukien', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idns');
            $table->string('title', 255);
            $table->text('mota')->nullable();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('loai');
            $table->integer('trangthai');
            $table->foreign('idns')->references('id')->on('nhansu');
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
        Schema::dropIfExists('sukien');
    }
}
