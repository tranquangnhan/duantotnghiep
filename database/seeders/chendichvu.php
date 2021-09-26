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
            ['name'=>'Làm đẹp', 'slug'=>'lam-dep', 'img'=>'lamdep.jpg', 'giamgia'=> 1, 'iddm'=> 1, 'motangan'=>'Lam dep - Những phương pháp làm đẹp da, tóc đẹp, cải thiện vóc dáng hiệu quả và đơn giản. Chia sẻ về cách chọn mỹ phẩm, trang điểm, trị mụn', 'dongia'=>200000, 'noidung'=>'Có phải bạn sẽ cười tươi hơn, tự tin ngẩn cao đầu khi có ai đó khen bạn: "Trông bạn thật xinh đẹp!". Hãy chân thật với chính mình, bạn thật sự muốn mình xinh đẹp để tự tin gặp gỡ bất kỳ ai và cuốn hút họ ngay cái nhìn đầu tiên, hay bạn muốn mình cứ xuề xòa, luộm thuộm để mong chờ người khác thấy vẻ đẹp tâm hồn bên trong con người bạn? ', 'trangthai'=> 1]
        ]);

    }
}
