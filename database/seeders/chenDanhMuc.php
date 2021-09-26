<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class chenDanhMuc extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('danhmuc')->insert([
            [ 'name' => 'phun săm thẩm mỹ', 'slug' => 'phun-sam-tham-my'],
            [ 'name' => 'làm mắt', 'slug' => 'lam-mat'],
            [ 'name' => 'làm môi', 'slug' => 'lam-moi'],
        ]);
    }
}
