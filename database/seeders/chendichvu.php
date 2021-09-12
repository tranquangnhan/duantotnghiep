<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class chendichvu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dichvu')->insert([
            ['tendv'=>'Phun môi collagen', 'slug'=>'phun-môi-collagen','img'=>'1.jpg','iddm'=> 1,'mota'=>'đẹp lắm hihi','gia'=>'650000','content'=>'ạhfjhkjdhfjdfhjdfsdffdfd','created_at'=> '2021-08-29 20:56:18','updated_at'=> NULL],
        ]);

    }
}
