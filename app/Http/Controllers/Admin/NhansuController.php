<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NhanSu;
use App\Repositories\Dichvu\DichvuRepositoryInterface;
use App\Repositories\Nhansu\NhansuRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NhansuController extends Controller
{
    protected $nhansu;
    protected $dichvu;

    public function __construct(NhansuRepositoryInterface $nhansu, DichvuRepositoryInterface $dichvu)
    {
        $this->nhansu=$nhansu;
        $this->dichvu=$dichvu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data= $this->nhansu->getNhansu();
        return view('Admin.Nhansu.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=$this->dichvu->getAll();
        return view('Admin.Nhansu.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NhanSu $request)
    {
        $CheckEmail= $this->nhansu->CheckEmail($request->email);
        if ($CheckEmail==true){
            $ns=[
                'name'=>$request->tennv,
                'email'=>$request->email,
                'namsinh'=>$request->namsinh,
                'chucvu'=>$request->chucvu,
                'password'=>bcrypt($request->password),
                'luong'=>$request->luong,
                'gioitinh'=>$request->gioitinh,
                'role'=>$request->role,
                'iddv'=>$request->dichvu,
                'img'=>basename($_FILES["urlHinh"]["name"]),
                'danhgia'=>$request->danhgia
            ];
            $target_dir    = 'admin/images/users/';
            $target_file   = $target_dir . basename($_FILES["urlHinh"]["name"]);
            move_uploaded_file($_FILES["urlHinh"]["tmp_name"], $target_file);
            $this->nhansu->create($ns);
            return redirect('/quantri/nhansu')->with('thanhcong', 'Thêm nhân sự thành công');
        }
        else{
            return redirect('/quantri/nhansu')->with('thatbai', 'Thêm nhân sự thành công');
        }
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
        $data=$this->nhansu->editNhansu($id);
        return view('Admin.Nhansu.edit', compact('data'));
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
        $password=$request->matkhau;
        $urlHinh=basename($_FILES["urlAnh"]["name"]);
        if ($password==""){
            $password=$request->pass;
        }
        if ($urlHinh==""){
            $urlHinh=$request->img;
        }
        else{
            $target_dir    = 'admin/images/users/';
            $target_file   = $target_dir . basename($_FILES["urlAnh"]["name"]);
            move_uploaded_file($_FILES["urlAnh"]["tmp_name"], $target_file);
        }
        $ns=[
            'name'=>$request->tennv,
            'namsinh'=>$request->namsinh,
            'chucvu'=>$request->chucvu,
            'password'=>bcrypt($password),
            'luong'=>$request->luong,
            'gioitinh'=>$request->gioitinh,
            'role'=>$request->role,
            'iddv'=>$request->dichvu,
            'img'=>$urlHinh,
            'danhgia'=>$request->danhgia
        ];

        $this->nhansu->update($id, $ns);
        return redirect('/quantri/nhansu')->with('thanhcong', 'Sửa nhân sự thành công');
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
            $this->nhansu->delete($id);
            return redirect('/quantri/nhansu')->with('thanhcong', 'Xóa thành công');
        }
        else{
            return redirect('/quantri/nhansu')->with('thatbai', 'Xóa thất bại');
        }
    }
}
