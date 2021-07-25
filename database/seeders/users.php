<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'Nhân'
            ,'email'=>'tranquangnhan1606@gmail.com',
            'password'=> bcrypt(111111),
            'namsinh'=>2000,
            'gioitinh'=>1,
            'img'=>'https://scontent-xsp1-2.xx.fbcdn.net/v/t1.6435-9/105521212_2769635456591039_1963757314300569785_n.jpg?_nc_cat=104&ccb=1-3&_nc_sid=09cbfe&_nc_ohc=Msl9Ro2WDUwAX8N1PYo&_nc_ht=scontent-xsp1-2.xx&oh=b75c4ca063573ab8b7e435b843ef20a0&oe=6122B839',
            'role'=>1,
            'iddv'=>1,
            'danhgia'=>5,
            'taikhoan'=>'tranquangnhan',
            'chucvu'=>'giám đốc',
            'luong'=>10000000
        ],
            
        ]);

    }
}
