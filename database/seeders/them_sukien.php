<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class them_sukien extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date("Y-m-d H:i:s");
        DB::table('sukien')->insert([
            ['idns' => 3, 'tieude' => 'Xin nghỉ bị bửa đó làm biếng quá', 'mota' => '', 'start' => $date, 'end'=> $date, 'loai' => 0, 'trangthai' => 1],
            ['idns' => 2, 'tieude' => 'Thích thì nghỉ', 'mota' => '', 'start' => $date, 'end'=> $date, 'loai' => 0, 'trangthai' => 0]
        ]);
    }
}
