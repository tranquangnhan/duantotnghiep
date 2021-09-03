<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const ROLE_ADMIN = 1;
    const ROLE_NHANVIEN = 2;
    const CHAMCONG_OFF = 0;
    const CHAMCONG_ON = 1;
    const CHAMCONG_OFF_ACCEPT = 2;
    const TIME_CAN_DELETE_CHAMCONG = 30; // MINUTES

    public function moveIMG($name, $tmp)
    {
        $target_dir = 'admin/images/users/';
        $target_file = $target_dir . $name;
        move_uploaded_file($tmp, $target_file);
    }

}
