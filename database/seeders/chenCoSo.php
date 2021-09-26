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
            ['name'=>'Cơ sở 1', 'tinh'=>'4', 'quan'=>'43', 'huyen'=>'1343']
        ]);
    }
}
