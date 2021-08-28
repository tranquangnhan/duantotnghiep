<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\SuKienModel;
use DateTime;
use Carbon\Carbon;

class SuKienContronller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.sukien.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        $idns = auth()->user()->id;
        if ($request->loai == Controller::LOAI_XIN_NGHI) {
            $trangThai = Controller::STATUS_XIN_NGHI;
        }
        else {
            $trangThai = Controller::STATUS_SUKIEN;
        }

        $sukien = SuKienModel::create([
            'idns' => $idns,
            'title' => $request->title,
            'mota' => $request->mota,
            'start' => $request->start,
            'end' => $request->end,
            'loai' => $request->loai,
            'trangthai' => $trangThai
        ]);

        if ($sukien->loai == Controller::LOAI_SUKIEN) {
            $message = 'Thêm sự kiện thành công :)';
        } else if ($sukien->loai == Controller::LOAI_XIN_NGHI) {
            $message = 'Xin nghỉ thành công :)';
        }

        $response = Array(
            'success' => true,
            'titleMess' => 'Thành công !',
            'textMess' => $message,
            'sukien' => $sukien,
        );

        return $response;
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
        $sukien = SuKienModel::find($id)->update([
            'title' => $request->title,
            'mota' => $request->mota,
            'start' => $request->start,
            'end' => $request->end,
            'loai' => $request->loai,
            'trangthai' => $request->trangthai,
        ]);

        $message = 'Cập nhật sự kiện thành công';

        $response = Array(
            'success' => true,
            'titleMess' => 'Thành công !',
            'textMess' => $message,
            'sukien' => $sukien,
        );

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

        //return 132;



    public function getSukien(Request $request)
    {
        $data = SuKienModel::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end', 'mota', 'loai', 'trangthai']);

        return response()->json($data);
    }

    public function action(Request $request)
    {
        try {
            if ($request->ajax())
            {
                if ($request->type == 'add')
                {
                    // check validate
                    $error = false;
                    if ($request->title == "") {
                        $error = true;
                        $titleMess = 'Đã xảy ra lỗi !';
                        $textMess = 'Tiêu đề không được rống.';
                    }
                    // check date
                    $today = date('Y-m-d');
                    $start = date("Y-m-d", strtotime($request->start));
                    if ($start < $today) {
                        $error = true;
                        $titleMess = 'Đã xảy ra lỗi !';
                        $textMess = 'Vui lòng chọn trước ngày hiện tại một ngày';
                    }

                    if ($error == false) {
                        $response = $this->store($request);
                    } else {
                        $response = Array(
                            'success' => false,
                            'titleMess' => $titleMess,
                            'textMess' => $textMess
                        );
                    }
                    return response()->json($response);
                }

                if ($request->type == 'resize') {
                    $response = $this->resize($request);
                    return response()->json($response);
                }

                if ($request->type == 'update')
                {
                    // check validate
                    $error = false;
                    if ($request->title == "") {
                        $error = true;
                        $titleMess = 'Đã xảy ra lỗi !';
                        $textMess = 'Tiêu đề không được rống.';
                    }
                    // check date
                    $today = date('Y-m-d');
                    $start = date("Y-m-d", strtotime($request->start));
                    if ($start < $today) {
                        $error = true;
                        $titleMess = 'Đã xảy ra lỗi !';
                        $textMess = 'Vui lòng chọn trước ngày hiện tại một ngày';
                    }

                    // if ($validError == false) {
                    //     $response = $this->update($request, $request->id);
                    // } else {
                    //     $response = Array(
                    //         'success' => false,
                    //         'message' => $error_mess,
                    //     );
                    // }
                    // return response()->json($response);
                }

                if($request->type == 'delete')
                {
                    $sukien = SuKienModel::find($request->id)->delete();
                    return response()->json($sukien);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'titleMess' => 'Đã xảy ra lỗi !',
                'textMess' => $e->getMessage()
            ]);
        }

    }

    public function resize(Request $request) {
        $sukien = SuKienModel::find($request->id)->update([
            'start' => $request->start,
            'end' => $request->end,
        ]);

        $message = 'Cập nhật sự kiện thành công :)';

        $response = Array(
            'success' => true,
            'titleMess' => 'Thành công !',
            'textMess' => $message,
            'sukien' => $sukien,
            'request' => $request->end,
        );

        return $response;
    }
}
