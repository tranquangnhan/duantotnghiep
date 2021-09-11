<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDichVu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dichvu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tendv',255);
            $table->string('slug',255);
            $table->string('img',255);
            $table->unsignedInteger('iddm');
            $table->text('mota');
            $table->double('gia',8,0);
            $table->text('content');
            $table->foreign('iddm')->references('id')->on('danhmuc');
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
        Schema::dropIfExists('dichvu');
    }
}
