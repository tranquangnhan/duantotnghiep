<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableNhanSu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhansu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('email',255);
            $table->smallInteger('namsinh');
            $table->boolean('gioitinh');
            $table->string('img',255);
            $table->unsignedInteger('idcv');
            $table->unsignedInteger('iddv');
            $table->text('danhgia')->nullable();
            $table->string('password');
            $table->double('luong',8,0);
            $table->rememberToken();
            $table->foreign('idcv')->references('id')->on('chucvu');
            $table->foreign('iddv')->references('id')->on('dichvu');
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
        Schema::dropIfExists('nhansu');
    }
}
