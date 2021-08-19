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
            $table->id();
            $table->string('name',255);
            $table->string('email',255);
            $table->smallInteger('namsinh');
            $table->boolean('gioitinh');
            $table->string('img',255);
            $table->unsignedTinyInteger('role')->default(0);
            $table->integer('iddv')->default(0);
            $table->text('danhgia');
            $table->string('password');
            $table->string('chucvu');
            $table->double('luong',10,0)->default(0);
            $table->string('remember_token',100);
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
        Schema::dropIfExists('table_nhan_su');
    }
}
