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
    const BASE_URL_UPLOAD = 'admin/images/users/';
    const ROLE_ADMIN = 1;
    const ROLE_NHANVIEN = 2;
    const CHAMCONG_OFF = 0;
    const CHAMCONG_ON = 1;
    const CHAMCONG_OFF_ACCEPT = 2;
    const TIME_CAN_DELETE_CHAMCONG = 30; // MINUTES
    const LOAI_SUKIEN = 0;
    const LOAI_XIN_NGHI = 1;
    const LOAI_MEETING = 2;
    const STATUS_SUKIEN = 0;
    const STATUS_XIN_NGHI = 1;
    const STATUS_ACCEPT_XIN_NGHI = 2;

    public function uploadManyImage($request)
    {
        $allowedfileExtension = ['jpg', 'png', 'gif'];
        $imgAnh = "";
        $dateTime  = time();
        foreach ($request as $id => $row) {
            $extension = $row->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if (!$check) {
                die("ảnh không hợp lệ");
                break;
            } else {
                $imgAnh .= $dateTime.'-'.$request[$id]->getClientOriginalName() . ',';
                $imgtmp = $request[$id]->getPathName();
                $upImages = $dateTime.'-'.$request[$id]->getClientOriginalName();
                $target_dir = Controller::BASE_URL_UPLOAD;
                $target_file = $target_dir . $upImages;
                move_uploaded_file($imgtmp, $target_file);
            }
        }
        $imgHinh = rtrim($imgAnh, ','); 
        return $imgHinh;
    }
}
