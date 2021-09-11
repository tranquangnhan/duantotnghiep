<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class chenNhanSu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nhansu')->insert([
            ['name'=>'ngoanhquoc', 'email'=>'ngoanhquoc@gmail.com','namsinh'=> 2000,'gioitinh'=> 1, 'img'=>'quốc.jpg','idcv'=> 1,'iddv'=> 1, 'danhgia'=>'5','password'=> '$2y$10$iimuFe7voEEthMTFQvRBX.hk1XrL3O1W7lXTZPCxktAIWkuEmY692','luong'=> 1000000000,'remember_token'=> 'hJ5bPBxgp9UsxQhEyS0BNTSmUTkaEz40lZ2evGmzsa6ZIQSYTSRxto1RejYq','created_at'=> '2021-08-16 20:56:18','updated_at'=> NULL],
            ['name'=>'Nhân', 'email'=>'tranquangnhan1606@gmail.com','namsinh'=> 2000,'gioitinh'=> 1, 'img'=>'nhan.jpg','idcv'=> 1,'iddv'=> 1, 'danhgia'=>'5','password'=> '$2y$10$Pmr.7sQX/HnGhwq8ZzlOPuZ9P.yBZ1XSxoRINN4arsLVGR6.6lxf6','luong'=> 1000000000,'remember_token'=> 'JeiM3160NnkNkOtcgeiglDnM9XBo6iEhsMkfni3DM4pfJbrGOn5zqs4gTfUI','created_at'=> '2021-08-16 20:56:18','updated_at'=> NULL],
            ['name'=>'Long Đẹp Trai', 'email'=>'longnh.2401@gmail.com','namsinh'=> 2001,'gioitinh'=> 1, 'img'=>'avt.jpg','idcv'=> 1,'iddv'=> 1, 'danhgia'=>'5','password'=> bcrypt('123123123'),'luong'=> 1000000000,'remember_token'=> 'hJ5bPBxgp9UsxQhEyS0BNTSmUTkaEz40lZ2evGmzsa6ZIQSYTSRxto1RejYq','created_at'=> '2021-08-16 20:56:18','updated_at'=> NULL],
            ['name'=>'Tuong', 'email'=>'tuong2712@gmail.com','namsinh'=> 2001,'gioitinh'=> 1, 'img'=>'avt.jpg','idcv'=> 1,'iddv'=> 1, 'danhgia'=>'5','password'=> '$2y$10$nlRY7DRJfQQLSbI0aV7h9usw0waQxL9uGbNFQChi.06.YIigQCC3q','luong'=> 1000000000,'remember_token'=> 'hJ5bPBxgp9UsxQhEyS0BNTSmUTkaEz40lZ2evGmzsa6ZIQSYTSRxto1RejYq','created_at'=> '2021-08-16 20:56:18','updated_at'=> NULL],
            ['name'=>'Nhân Viên', 'email'=>'nhanvien@gmail.com','namsinh'=> 2001,'gioitinh'=> 1, 'img'=>'avt.jpg','idcv'=> 1,'iddv'=> 1, 'danhgia'=>'5','password'=> bcrypt('123123123'),'luong'=> 1000000000,'remember_token'=> 'hJ5bPBxgp9UsxQhEyS0BNTSmUTkaEz40lZ2evGmzsa6ZIQSYTSRxto1RejYq','created_at'=> '2021-08-16 20:56:18','updated_at'=> NULL],
        ]);

    }
}
