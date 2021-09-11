<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Admin;
use Illuminate\Http\Request;
use App\Repositories\Chamcong\ChamcongRepository;
use App\Models\admin\ChamCongModel;
use App\Models\admin\NhansuModel;
use Carbon\Carbon;

class ChamCongController extends Controller
{
    private $Chamcong;

    /**
     * DanhMucController constructor.
     */
    public function __construct(ChamcongRepository $Chamcong)
    {
        $this->Chamcong = $Chamcong;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = $this->Chamcong->getAll();
        $data = ChamCongModel::orderByDesc('id')->get();

        $this->getDuLieuChoViecChamCong($data);

        return view('Admin.Chamcong.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today = date("Y-m-d");

        $idns = auth()->user()->id;
        $chamCong = ChamCongModel::where('idns', $idns)
        ->where('ngay', '=', $today)
        ->orderByDesc('id')->limit(1)
        ->first();
        // không có chấm công nào
        if ($chamCong == null)
        {
            $checkIn = Carbon::now()->timestamp;
            $newChamCong = new ChamCongModel;
            $newChamCong->checkin = $checkIn;
            $newChamCong->ngay = $today;
            $newChamCong->idns = $idns;
            $newChamCong->trangthai = Controller::CHAMCONG_ON;
            $newChamCong->save();
        }
        else
        {
            // có nhiều hơn 1 lần chấm công
            if ($chamCong->checkout == null && $chamCong->checkin != null)
            {
                // không có check out thì thêm check out\
                $checkOut = Carbon::now()->timestamp;
                $chamCong->checkout = $checkOut;
                $chamCong->save();
            }
            else
            {
                $checkIn = Carbon::now()->timestamp;

                $newChamCong = new ChamCongModel;
                $newChamCong->checkin = $checkIn;
                $newChamCong->ngay = $today;
                $newChamCong->idns = $idns;
                $newChamCong->trangthai = Controller::CHAMCONG_ON;
                $newChamCong->save();
            }
        }

        return redirect('/quantri/chamcong')->with('success', 'Chấm công thành công!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id > 0) {
            $chamCong = $this->Chamcong->find($id);
            $checkDelete = $this->checkDelete($chamCong);

            if ($checkDelete == true) {
                $this->Chamcong->delete($id);

                $respon = [
                    'title' => 'Đã xóa!',
                    'text' => 'Chấm công id ' . $id . ' đã xóa thành công',
                    'status' => 'success'
                ];

            } else {
                $respon = [
                    'title' => 'Đã xảy ra lỗi!',
                    'text' => 'Chấm công sau 30 phút sẽ không thể xóa !',
                    'status' => 'error'
                ];
            }

            return response()->json($respon);
        }
    }

    public function chamcongcuatoi($id)
    {
        $listChamCong = ChamCongModel::where('idns', $id)
        ->orderByDesc('id')
        ->get();

        $this->getDuLieuChoViecChamCong($listChamCong);

        return view('Admin.Chamcong.chamcongcuatoi',compact('listChamCong'));
    }

    public function getDuLieuChoViecChamCong($list) {
        foreach ($list as $item) {
            // nhan su
            $nhansu = $nhansu = NhansuModel::where('id', $item->idns)
            ->orderByDesc('id')
            ->first();

            if ($nhansu != null) {
                $item->nhansu = $nhansu;
            }


            // trang thai
            if ($item->trangthai == 1)
            {
                $item->tenTrangThai = 'Đi làm';
                $item->class = 'primary';
            }
            else if ($item->trangthai == 2)
            {
                $item->tenTrangThai = 'Xin nghỉ/đã duyệt';
                $item->class = 'primary';
            }
            else if ($item->trangthai == 0)
            {
                $item->tenTrangThai = 'Xin nghỉ/chưa duyệt';
                $item->class = 'warning';
            }

            // quyền delete
            $item->delete = $this->checkDelete($item);
        }
    }

    public function checkDelete($row) {
        $idns = auth()->user()->id;
        $timestampNow = Carbon::now()->timestamp;
        $checkIn30_trongdb = $row->checkin + (Controller::TIME_CAN_DELETE_CHAMCONG * 60);
        if ($checkIn30_trongdb > $timestampNow && $row->idns == $idns) {
            return true;
        } else {
            return false;
        }
    }

}
