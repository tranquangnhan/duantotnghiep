<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoTablecoso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coso', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('tinh', 5);
            $table->string('quanhuyen', 5);
            $table->string('diachi', 5);
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
        Schema::dropIfExists('coso');
    }
}
