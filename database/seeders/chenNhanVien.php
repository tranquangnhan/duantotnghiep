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
        DB::table('nhanvien')->insert([
            ['idcoso'=>1,'iddichvu'=>1, 'email'=>'ngoanhquoc@gmail.com','password'=> '$2y$10$iimuFe7voEEthMTFQvRBX.hk1XrL3O1W7lXTZPCxktAIWkuEmY692','role'=>1 ,'active'=>1 ,'name'=>'Ngô Anh Quốc', 'img'=>'quốc.jpg', 'namsinh'=> 2000,'gioitinh'=> 1, 'sdt'=> '012345678', 'avatar'=>'quoc.jpg','trangthai'=> 1,'remember_token'=> 'hJ5bPBxgp9UsxQhEyS0BNTSmUTkaEz40lZ2evGmzsa6ZIQSYTSRxto1RejYq','created_at'=> '2021-08-16 20:56:18','updated_at'=> NULL],
            ['idcoso'=>1,'iddichvu'=>1, 'email'=>'longnh.2401@gmail.com','password'=> bcrypt('123123123'),'role'=>1 ,'active'=>1 ,'name'=>'Long', 'img'=>'quốc.jpg', 'namsinh'=> 2000,'gioitinh'=> 1, 'sdt'=> '012345678', 'avatar'=>'quoc.jpg','trangthai'=> 1,'remember_token'=> 'hJ5bPBxgp9UsxQhEyS0BNTSmUTkaEz40lZ2evGmzsa6ZIQSYTSRxto1RejYq','created_at'=> '2021-08-16 20:56:18','updated_at'=> NULL],
            ['idcoso'=>1,'iddichvu'=>1, 'email'=>'tuong2712@gmail.com','password'=> '$2y$10$nlRY7DRJfQQLSbI0aV7h9usw0waQxL9uGbNFQChi.06.YIigQCC3q','role'=>1 ,'active'=>1 ,'name'=>'Tưởng', 'img'=>'quốc.jpg', 'namsinh'=> 2000,'gioitinh'=> 1, 'sdt'=> '012345678', 'avatar'=>'quoc.jpg','trangthai'=> 1,'remember_token'=> 'hJ5bPBxgp9UsxQhEyS0BNTSmUTkaEz40lZ2evGmzsa6ZIQSYTSRxto1RejYq','created_at'=> '2021-08-16 20:56:18','updated_at'=> NULL],
            ['idcoso'=>1,'iddichvu'=>1, 'email'=>'nhanvien@gmail.com','password'=> bcrypt('123123123'),'role'=>1 ,'active'=>1 ,'name'=>'nhân viên', 'img'=>'quoc.jpg', 'namsinh'=> 2000,'gioitinh'=> 1, 'sdt'=> '012345678', 'avatar'=>'quoc.jpg','trangthai'=> 1,'remember_token'=> 'hJ5bPBxgp9UsxQhEyS0BNTSmUTkaEz40lZ2evGmzsa6ZIQSYTSRxto1RejYq','created_at'=> '2021-08-16 20:56:18','updated_at'=> NULL],
            ['idcoso'=>1,'iddichvu'=>1, 'email'=>'tranquangnhan1606@gmail.com','password'=> '$2y$10$Pmr.7sQX/HnGhwq8ZzlOPuZ9P.yBZ1XSxoRINN4arsLVGR6.6lxf6','role'=>1 ,'active'=>1 ,'name'=>'Nhân', 'img'=>'quốc.jpg', 'namsinh'=> 2000,'gioitinh'=> 1, 'sdt'=> '012345678', 'avatar'=>'quoc.jpg','trangthai'=> 1,'remember_token'=> 'hJ5bPBxgp9UsxQhEyS0BNTSmUTkaEz40lZ2evGmzsa6ZIQSYTSRxto1RejYq','created_at'=> '2021-08-16 20:56:18','updated_at'=> NULL],

        ]);

    }
}
