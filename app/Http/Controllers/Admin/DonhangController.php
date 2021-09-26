<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Donhang\DonhangRepository;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class DonhangController extends Controller
{
    private $Donhang;
    /**
     * DanhMucController constructor.
     */
    public function __construct(DonhangRepository $Donhang)
    {
        $this->Donhang = $Donhang;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->Donhang->getAll();

        return view('Admin.Donhang.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $data  = $this->Donhang->find($id);
        return view('Admin.Donhang.edit',compact('data'));
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
        // $validated = $request->validate([
        //     'name' => 'required',
        // ],[
        //     'name.required'=>'Bạn chưa nhập tên danh mục',
        // ]);

        $data = [
            'idkh'=> $request->idkh,
            'idcs'=> $request->coso,
            'nhanvien'=> $request->nhanvien,
            'tongtien'=> $request->tongtien,
            'magg'=> $request->magiamgia,
            'tongtiengg'=> $request->tonggg,
            'ghichu'=> $request->ghichu,


        ];

        $this->Donhang->update($id,$data);

        return redirect('quantri/donhang')->with('success','Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->Donhang->delete($id);
        return redirect('quantri/donhang')->with('success','Xoá thành công');
    }
}
