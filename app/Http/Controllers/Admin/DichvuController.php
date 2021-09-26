<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dichvu;
// use App\Models\Admin\DichvuModel;
use App\Repositories\Danhmuc\DanhmucRepositoryInterface;
use App\Repositories\Dichvu\DichvuRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Validator;

class DichvuController extends Controller
{
    protected $dichvu;
    protected $danhmuc;

    public function __construct(DichvuRepositoryInterface $dichvu, DanhmucRepositoryInterface $danhmuc)
    {
        $this->dichvu= $dichvu;
        $this->danhmuc= $danhmuc;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data= $this->dichvu->getAll();
       $DanhMuc = $this->danhmuc->getAll();
     return view('Admin.Dichvu.index',compact('data','DanhMuc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=$this->dichvu->getAll();
        $DanhMuc = $this->danhmuc->getAll();
        return view('Admin.Dichvu.create', compact('data','DanhMuc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Dichvu $request)
    {
        $allowedfileExtension = ['jpg', 'png', 'gif'];
        $imgAnh = "";
        $files = $request->file('urlHinh');
        foreach ($files as $id => $row) {
            $extension = $row->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if (!$check) {
                //bắt lỗi
                echo "ảnh không hợp lệ";
                break;
            } else {
                $imgAnh .= $_FILES["urlHinh"]["name"][$id] . ',';
                $imgtmp = $_FILES["urlHinh"]["tmp_name"][$id];
                $upImages = $_FILES["urlHinh"]["name"][$id];

                $this->moveIMG($upImages, $imgtmp);
            }
        }
        $imgHinh = rtrim($imgAnh, ',');
            $name = $request->name;
            $dv=[
                'name'=>$request->name,
                'slug'=>strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name))),
                'gia'=>$request->gia,
                'mota'=>$request->mota,
                'iddm'=>$request->danhmuc,
                'img'=>$imgHinh,
                'content'=>$request->content
            ];
          
            $this->dichvu->create($dv);
            return redirect('/quantri/dichvu')->with('thanhcong', 'Thêm Dịch vụ thành công');
     
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
        $data=$this->dichvu->editDichVu($id);
        $DanhMuc = $this->danhmuc->getAll();
        return view('Admin.Dichvu.edit', compact('data','DanhMuc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Dichvu $request, $id)
    {
        $name = $request->name;
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

        $dv=[
            'name'=>$request->name,
            'slug'=>strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name))),
            'gia'=>$request->gia,
            'mota'=>$request->mota,
            'iddm'=>$request->danhmuc,
            'img' => $imgHinh,
            'content'=>$request->content
        ];

        $this->dichvu->update($id, $dv);
        return redirect('/quantri/dichvu')->with('thanhcong', 'Sửa dịch vụ thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->id != $id){
            $this->dichvu->delete($id);
            return redirect('/quantri/dichvu')->with('thanhcong', 'Xóa thành công');
        }
        else{
            return redirect('/quantri/dichvu')->with('thatbai', 'Xóa thất bại');
        }
    }
}
