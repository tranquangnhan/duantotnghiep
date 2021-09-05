<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KhachHang;
// use App\Models\Admin\KhachHangModel;
use App\Repositories\Khachhang\KhachhangRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class KhachHangController extends Controller
{
    protected $khachhang;

    public function __construct(KhachhangRepository $khachhang)
    {
        $this->khachhang= $khachhang;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data= $this->khachhang->getAll();
     return view('Admin.Khachhang.indexadd',compact('data'));
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KhachHang $request)
    {
        
            $kh=[
                'name'=>$request->name,
                'sdt'=>$request->sdt,
            ];
          
            $this->khachhang->create($kh);
            return redirect('/quantri/khachhang')->with('thanhcong', 'Thêm khách hàng thành công');
     
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
        $data=$this->khachhang->editKhachHang($id);
        return view('Admin.KhachHang.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KhachHang $request, $id)
    {
      
        $dv=[
            'name'=>$request->name,
            'sdt'=>$request->sdt,
        ];

        $this->khachhang->update($id, $dv);
        return redirect('/quantri/khachhang')->with('thanhcong', 'Sửa khách hàng thành công');
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
            $this->khachhang->delete($id);
            return redirect('/quantri/khachhang')->with('thanhcong', 'Xóa thành công');
        }
        else{
            return redirect('/quantri/khachhang')->with('thatbai', 'Xóa thất bại');
        }
    }
}
