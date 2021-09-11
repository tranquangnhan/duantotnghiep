<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class themChucVu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chucvu')->insert([
            [ 'name' => 'admin', 'role' => '0'],
            [ 'name' => 'manager', 'role' => '1'],
            [ 'name' => 'staff', 'role' => '2'],
        ]);
    }
}
