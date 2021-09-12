<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class chenCoSo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coso')->insert([
            [ 'name' => 'Cơ sở Nam Kì', 'tinh' => '01', 'quanhuyen'=>'001', 'diachi'=>'00001'],
            [ 'name' => 'Cơ sở Quận 12', 'tinh' => '02', 'quanhuyen'=>'002', 'diachi'=>'00002'],
        ]);
    }
}
