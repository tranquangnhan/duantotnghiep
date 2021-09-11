<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NhanSu;
use App\Http\Requests\NhanSuUpdate;
use App\Repositories\Dichvu\DichvuRepositoryInterface;
use App\Repositories\Nhansu\NhansuRepositoryInterface;
use App\Repositories\Chucvu\ChucvuRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NhansuController extends Controller
{
    protected $nhansu;
    protected $dichvu;
    protected $chucvu;
    public function __construct(
        NhansuRepositoryInterface $nhansu,
        DichvuRepositoryInterface $dichvu,
        ChucvuRepositoryInterface $chucvu
    )
    {
        $this->nhansu = $nhansu;
        $this->dichvu = $dichvu;
        $this->chucvu = $chucvu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = $this->nhansu->getAll();
        
        return view('Admin.Nhansu.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        $data = $this->dichvu->getAll();
        $chucvu = $this->chucvu->getAll();

        return view('Admin.Nhansu.create', ['data'=>$data,'chucvu'=>$chucvu]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NhanSu $request)
    {
        $imgHinh = $this->uploadManyImage($request->file('urlAnh'));
        $CheckEmail = $this->nhansu->CheckEmail($request->email);
        if ($CheckEmail == true) {
            $ns = [
                'name' => $request->tennv,
                'email' => $request->email,
                'namsinh' => $request->namsinh,
                'gioitinh' => $request->gioitinh,
                'img' => $imgHinh,
                'idcv' => $request->idcv,
                'iddv' => $request->dichvu,
                'password' => bcrypt($request->password),
                'luong' => $request->luong,
                'danhgia' => $request->danhgia
            ];
            $this->nhansu->create($ns);
            return redirect('/quantri/nhansu')->with('thanhcong', 'Thêm nhân sự thành công');
        } else {
            return redirect('/quantri/nhansu')->with('thatbai', 'Email đã được sử dụng');
        }
    }

    /**
     *move images upload
     */

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->nhansu->editNhansu($id);
        $DichVu = $this->dichvu->getAll();
        return view('Admin.Nhansu.edit', compact('data', 'DichVu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(NhanSuUpdate $request, $id)
    {
        $password = $request->matkhau;
        if ($password == "") {
            $password = $request->pass;
        }

        $urlHinh = $request->file('urlAnh');
        $imgHinh = "";

        if ($urlHinh == null) {
            $imgHinh .= $request->img;
        } else {
            $allowedfileExtension = ['jpg', 'png', 'gif'];
            $imgAnh = "";
            foreach ($urlHinh as $index => $row) {
                $extension = $row->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if (!$check) {
                    //bắt lỗi
//                    echo  basename($_FILES["urlAnh"]["name"][$id]);
                    echo "ảnh không hợp lệ";
                    break;
                } else {
                    $imgAnh .= $_FILES["urlAnh"]["name"][$index] . ',';
                    $imgtmp = $_FILES["urlAnh"]["tmp_name"][$index];
                    $upImages = $_FILES["urlAnh"]["name"][$index];
                    $this->moveIMG($upImages, $imgtmp);
                }
            }
            $imgHinh .= rtrim($imgAnh, ',');
        }

        $ns = [
            'name' => $request->tennv,
            'namsinh' => $request->namsinh,
            'chucvu' => $request->chucvu,
            'password' => bcrypt($password),
            'luong' => $request->luong,
            'gioitinh' => $request->gioitinh,
            'role' => $request->role,
            'iddv' => $request->dichvu,
            'img' => $imgHinh,
            'danhgia' => $request->danhgia
        ];
        $this->nhansu->update($id, $ns);
        return redirect('/quantri/nhansu')->with('thanhcong', 'Sửa nhân sự thành công');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->id != $id) {
            $this->nhansu->delete($id);
            return redirect('/quantri/nhansu')->with('thanhcong', 'Xóa thành công');
        } else {
            return redirect('/quantri/nhansu')->with('thatbai', 'Xóa thất bại');
        }
    }

    public function LongGetNhanSu(Request $request, $id) {
        try {
            if ($request->ajax())
            {
                $nhansu = $this->nhansu->getDetailNhanSu($id);

                if ($nhansu == null) {
                    $response = Array(
                        'success'    => false,
                        'titleMess'  => 'Đã xảy ra lỗi !',
                        'textMess'   => 'Không tìm thấy nhân sự :(',
                    );
                } else {
                    $response = Array(
                        'success'  => true,
                        'nhansu'   => $nhansu,
                    );
                }
                return response()->json($response);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success'    => false,
                'titleMess'  => 'Đã xảy ra lỗi !',
                'textMess'   => $e->getMessage()
            ]);
        }
    }
}
