<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class them_chamcong extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $checkIn = date(time());
        $checkOut = date(time()) + 2000;
        DB::table('chamcong')->insert([
            ['checkin' => 1629421842, 'checkout' => 1629421842, 'ngay' => '2021-08-20','idns' => 6, 'trangthai' => 1],
            ['checkin' => 1629421842 + 1000, 'checkout' => 1629421842 + 1000, 'ngay' => '2021-08-20', 'idns' => 7, 'trangthai' => 1],
            ['checkin' => 1629421842 + 2000, 'checkout' => 1629421842 + 2000, 'ngay' => '2021-08-20', 'idns' => 8, 'trangthai' => 1]
        ]);
    }
}
