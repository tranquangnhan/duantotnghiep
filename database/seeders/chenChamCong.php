<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class chenChamCong extends Seeder
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
            ['checkin' => 1629421842, 'checkout' => 1629421842, 'ngay' => '2021-08-20','idns' => 2, 'trangthai' => 1],
            ['checkin' => 1629421842 + 1000, 'checkout' => 1629421842 + 1000, 'ngay' => '2021-08-20', 'idns' => 3, 'trangthai' => 1],
            ['checkin' => 1629421842 + 2000, 'checkout' => 1629421842 + 2000, 'ngay' => '2021-08-20', 'idns' => 4, 'trangthai' => 1]
        ]);
    }
}
