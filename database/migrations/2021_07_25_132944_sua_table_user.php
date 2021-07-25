<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SuaTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
         
            $table->unsignedSmallInteger('namsinh')->length(4)->default(0);
            $table->unsignedTinyInteger('gioitinh')->default(0);
            $table->string('img',255)->nullable();
            $table->unsignedTinyInteger('role')->default(0);
            $table->integer('iddv')->default(0);
            $table->text('danhgia')->nullable();
            $table->string('taikhoan',255)->nullable();
            $table->string('chucvu',255)->nullable();
            $table->double('luong',8,0)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            
          
        });
    }
}
