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
     return view('Admin.Dichvu.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=$this->dichvu->getAll();
        return view('Admin.Dichvu.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Dichvu $request)
    {
            $name = $request->name;
            $dv=[
                'name'=>$request->name,
                'slug'=>strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name))),
                'gia'=>$request->gia,
                'mota'=>$request->mota,
                'iddm'=>$request->danhmuc,
                'img'=>basename($_FILES["urlHinh"]["name"]),
                'content'=>$request->content
            ];
            $target_dir    = 'admin/images/dichvu/';
            $target_file   = $target_dir . basename($_FILES["urlHinh"]["name"]);
            move_uploaded_file($_FILES["urlHinh"]["tmp_name"], $target_file);
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
        return view('Admin.Dichvu.edit', compact('data'));
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
        $name = $request->name;
        $urlHinh=basename($_FILES["urlAnh"]["name"]);

        if ($urlHinh==""){
            $urlHinh=$request->img;
        }
        else{
            $target_dir    = 'admin/images/dichvu/';
            $target_file   = $target_dir . basename($_FILES["urlAnh"]["name"]);
            move_uploaded_file($_FILES["urlAnh"]["tmp_name"], $target_file);
        }
        $dv=[
            'name'=>$request->name,
            'slug'=>strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name))),
            'gia'=>$request->gia,
            'mota'=>$request->mota,
            'iddm'=>$request->danhmuc,
            'img'=>$urlHinh,
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
