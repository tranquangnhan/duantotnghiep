<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\SuKienModel;
use DateTime;
use Carbon\Carbon;
use App\Repositories\Sukien\SukienRepositoryInterface;
use Facade\FlareClient\Flare;

class SuKienController extends Controller
{
    protected $sukien;

    public function __construct(SukienRepositoryInterface $sukien)
    {
        $this->sukien = $sukien;
    }

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
            // 'start' => $request->start,
            // 'end' => $request->end,
            'loai' => $request->loai,
            // 'trangthai' => $request->trangthai,
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
        $sukien = SuKienModel::find($id);

        if ($sukien == null) {
            $response = Array(
                'success' => false,
                'titleMess' => 'Đã xảy ra lỗi !',
                'textMess' => 'Không tìm thấy sự kiện',
                'sukien' => $sukien,
            );
        } else {
            $message = '';
            if ($sukien->loai == Controller::LOAI_SUKIEN) {
                $message = 'Sự kiện đã xóa thành công :)';
            } else if ($sukien->loai == Controller::LOAI_XIN_NGHI) {
                $message = 'Lịch nghỉ đã xóa thành công :)';
            }


            $sukien->delete();
            $response = Array(
                'success' => true,
                'titleMess' => 'Thành công !',
                'textMess' => $message,
                'sukien' => $sukien,
            );
        }

        return $response;
    }

        //return 132;



    public function getSukien(Request $request)
    {
        $data = SuKienModel::whereDate('start', '>=', $request->start)
        ->whereDate('end', '<=', $request->end)
        ->get(['id', 'idns', 'title', 'start', 'end', 'mota', 'loai', 'trangthai']);

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
                    $idns = auth()->user()->id;
                    if ($request->idns == $idns) {
                        $response = $this->resize($request);
                    } else {
                        $response = Array(
                            'success' => false,
                            'titleMess' => 'Đã xảy ra lỗi !',
                            'textMess' => 'Bạn không có quyền sửa'
                        );
                    }
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

                    // check đúng user
                    $idns = auth()->user()->id;
                    if (!$request->idns == $idns) {
                        $error = true;
                        $titleMess = 'Đã xảy ra lỗi !';
                        $textMess = 'Bạn không có quyền sửa.';
                    }

                    if ($error == false) {
                        $response = $this->update($request, $request->id);
                    } else {
                        $response = Array(
                            'success' => false,
                            'titleMess' => $titleMess,
                            'textMess' => $textMess
                        );
                    }
                    return response()->json($response);
                }

                if ($request->type == 'updateTrangThaiXinNghi') {
                    $error = false;
                    $roleUserLogin = auth()->user()->role;
                    if (!$roleUserLogin == Controller::ROLE_ADMIN) {
                        $error = true;
                        $titleMess = 'Đã xảy ra lỗi !';
                        $textMess = 'Chỉ quản lý mới được sửa.';
                    }

                    $today = date('Y-m-d');
                    $start = date("Y-m-d", strtotime($request->start));
                    if ($start < $today) {
                        $error = true;
                        $titleMess = 'Đã xảy ra lỗi !';
                        $textMess = 'Không thể cập nhật lịch nghỉ đã qua';
                    }

                    if ($error == false) {
                        $response = $this->updateTrangThaiXinNghi($request->id, $request->trangThai);
                    } else {
                        $response = Array(
                            'success' => false,
                            'titleMess' => $titleMess,
                            'textMess' => $textMess
                        );
                    }

                    return response()->json($response);
                }

                if($request->type == 'delete')
                {
                    $error = false;
                    $idns = auth()->user()->id;
                    if (!$request->idns == $idns) {
                        $error = true;
                        $titleMess = 'Đã xảy ra lỗi !';
                        $textMess = 'Bạn không có quyền sửa.';
                    }

                    if ($error == false) {
                        $response = $this->destroy($request->id);
                    } else {
                        $response = Array(
                            'success' => false,
                            'titleMess' => $titleMess,
                            'textMess' => $textMess
                        );
                    }

                    return response()->json($response);
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

    public function updateTrangThaiXinNghi($id, $trangThai) {
        $sukien = $this->sukien->updateTrangThaiXinNghi($id, $trangThai);
        if ($sukien) {
            $response = Array(
                'success' => true,
                'titleMess' => 'Thành công !',
                'textMess' => 'Lịch nghỉ đã được cập nhật :)',
                'sukien' => $sukien
            );
        } else {
            $response = Array(
                'success' => false,
                'titleMess' => 'Cập nhật thất bại !',
                'textMess' => 'Đã xãy ra lỗi, vui lòng thử lại sau :('
            );
        }

        return $response;
    }
}
