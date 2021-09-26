<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InstallDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('danhmuc');
        Schema::dropIfExists('dichvu');
        Schema::dropIfExists('blog');
        Schema::dropIfExists('coso');
        Schema::dropIfExists('nhanvien');
        Schema::dropIfExists('khachhang');
        Schema::dropIfExists('giamgia');
        Schema::dropIfExists('lieutrinh');
        Schema::dropIfExists('lieutrinhchitiet');
        Schema::dropIfExists('hoadon');
        Schema::dropIfExists('hoadonchitiet');
        Schema::dropIfExists('datlich');
        Schema::dropIfExists('sanpham');
        Schema::dropIfExists('sanphamchitiet');
        Schema::dropIfExists('donhang');
        Schema::dropIfExists('donhangchitiet');

        Schema::create('danhmuc', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('slug',255);
            $table->boolean('loai');
            $table->timestamps();
        });

        Schema::create('dichvu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('slug',255);
            $table->string('img',255);
            $table->unsignedInteger('giamgia')->default(0);
            $table->unsignedInteger('iddm');
            $table->string('motangan',255);
            $table->double('dongia',10,0);
            $table->longText('noidung');
            $table->boolean('trangthai');
            $table->foreign('iddm')->references('id')->on('danhmuc');
            $table->timestamps();
        });


        Schema::create('blog', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('iddm');
            $table->string('name',255);
            $table->string('slug',255);
            $table->longText('noidung');
            $table->boolean('trangthai');
            $table->foreign('iddm')->references('id')->on('danhmuc');
            $table->timestamps();
        });


        Schema::create('coso', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->unsignedInteger('tinh');
            $table->unsignedInteger('quan');
            $table->unsignedInteger('huyen');
            $table->timestamps();
        });

        Schema::create('nhanvien', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idcoso');
            $table->unsignedInteger('iddichvu');
            $table->string('email',255)->unique();
            $table->string('password',255);
            $table->boolean('role',1);
            $table->boolean('active',1);
            $table->string('name',255);
            $table->string('img',255);
            $table->string('namsinh',4);
            $table->boolean('gioitinh',1);
            $table->string('sdt',10);
            $table->string('avatar',255);
            $table->boolean('trangthai',1);
            $table->foreign('idcoso')->references('id')->on('coso');
            $table->foreign('iddichvu')->references('id')->on('dichvu');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('khachhang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('sdt',10);
            $table->string('email',255)->unique();
            $table->string('password',255);
            $table->string('idgoogle',255);
            $table->boolean('active',1);
            $table->string('img',255);
            $table->string('randomkey',255);
            $table->unsignedInteger('exp');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('giamgia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('ma',50);
            $table->integer('number')->default(0);
            $table->double('max',10,0);
            $table->boolean('loai');
            $table->unsignedInteger('ngaytao');
            $table->unsignedInteger('ngayhethan');
            $table->timestamps();
        });

        Schema::create('lieutrinh', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idnhanvien');
            $table->unsignedInteger('idkhachhang');
            $table->unsignedInteger('ngaybatdau');
            $table->unsignedInteger('dukienketthuc');
            $table->string('ghichu',255);
            $table->boolean('trangthai');
            $table->foreign('idnhanvien')->references('id')->on('nhanvien');
            $table->foreign('idkhachhang')->references('id')->on('khachhang');
            $table->timestamps();
        });


        Schema::create('lieutrinhchitiet', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idlieutrinh');
            $table->unsignedInteger('iddichvu');
            $table->unsignedInteger('idnhanvien');
            $table->string('mota',255);
            $table->unsignedInteger('ngay');
            $table->boolean('trangthai');
            $table->string('imgkhachhang');
            $table->foreign('idlieutrinh')->references('id')->on('lieutrinh');
            $table->foreign('iddichvu')->references('id')->on('dichvu');
            $table->foreign('idnhanvien')->references('id')->on('nhanvien');
            $table->timestamps();
        });

        Schema::create('hoadon', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idkhachhang');
            $table->unsignedInteger('idcoso');
            $table->unsignedInteger('idnhanvien');
            $table->unsignedInteger('idthungan');
            $table->unsignedInteger('idlieutrinh');
            $table->unsignedInteger('idgiamgia');
            $table->double('tongtientruocgiamgia',10,0);
            $table->double('tongtiensaugiamgia',10,0);
            $table->boolean('trangthai');
            $table->string('ghichu',255);
            $table->foreign('idkhachhang')->references('id')->on('khachhang');
            $table->foreign('idcoso')->references('id')->on('coso');
            $table->foreign('idnhanvien')->references('id')->on('nhanvien');
            $table->foreign('idthungan')->references('id')->on('nhanvien');
            $table->foreign('idlieutrinh')->references('id')->on('lieutrinh');
            $table->foreign('idgiamgia')->references('id')->on('giamgia');
            $table->timestamps();
        });


        Schema::create('hoadonchitiet', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idhoadon');
            $table->unsignedInteger('idlienquan');
            $table->boolean('type');
            $table->unsignedInteger('soluong');
            $table->double('dongiatruocgiamgia',10,0);
            $table->double('dongiasaugiamgia',10,0);
            $table->foreign('idhoadon')->references('id')->on('hoadon');
            $table->timestamps();
        });


        Schema::create('datlich', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idcoso');
            $table->unsignedInteger('iddichvu');
            $table->unsignedInteger('idkhachhang');
            $table->unsignedInteger('idnhanvien');
            $table->unsignedInteger('thoigiandat');
            $table->foreign('idcoso')->references('id')->on('coso');
            $table->foreign('iddichvu')->references('id')->on('dichvu');
            $table->foreign('idkhachhang')->references('id')->on('khachhang');
            $table->foreign('idnhanvien')->references('id')->on('nhanvien');
            $table->timestamps();
        });


        Schema::create('sanpham', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('iddanhmuc');
            $table->string('name',255);
            $table->string('slug',255);
            $table->string('img',255);
            $table->string('mota',255);
            $table->longText('noidung');
            $table->boolean('trangthai');
            $table->foreign('iddanhmuc')->references('id')->on('danhmuc');
            $table->timestamps();
        });


        Schema::create('sanphamchitiet', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idsanpham');
            $table->tinyInteger('ml');
            $table->unsignedInteger('soluotmua');
            $table->unsignedInteger('tonkho');
            $table->double('dongia',10,0);
            $table->foreign('idsanpham')->references('id')->on('sanpham');
            $table->timestamps();
        });


        Schema::create('donhang', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idkhachhang');
            $table->unsignedInteger('idgiamgia');
            $table->string('tennguoinhan',255);
            $table->string('diachikhachhang',255);
            $table->string('sdtnguoinhan',10);
            $table->double('tongtientruocgiamgia',10,0);
            $table->double('tongtiensaugiamgia',10,0);
            $table->string('ghichucuakhachhang',255);
            $table->char('phuongthucthanhtoan',5);
            $table->char('phuongthucgiaohang',5);
            $table->boolean('trangthai');
            $table->timestamps();
        });


        Schema::create('donhangchitiet', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('iddonhang');
            $table->unsignedInteger('idsanpham');
            $table->string('img',255);
            $table->unsignedInteger('soluong');
            $table->double('dongiatruocgiamgia',10,0);
            $table->double('dongiasaugiamgia',10,0);
            $table->foreign('iddonhang')->references('id')->on('donhang');
            $table->foreign('idsanpham')->references('id')->on('sanpham');
            $table->timestamps();
        });


        Schema::enableForeignKeyConstraints();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::enableForeignKeyConstraints();
    }
}
