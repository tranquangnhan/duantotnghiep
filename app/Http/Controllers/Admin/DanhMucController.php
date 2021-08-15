<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Danhmuc\DanhmucRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class DanhMucController extends Controller
{
    private $Danhmuc;
    /**
     * DanhMucController constructor.
     */
    public function __construct(DanhmucRepository $Danhmuc)
    {
        $this->Danhmuc = $Danhmuc;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->Danhmuc->getAll();
        
       return view('Admin.Danhmuc.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Danhmuc.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ],[
            'name.required'=>'Bạn chưa nhập tên danh mục',
        ]);

        $data = [
            'name'=> $request->name,
            'slug'=>Str::slug($request->name)
        ];

        $this->Danhmuc->create($data);
        
        return redirect('admin123/danhmuc')->with('success','Thêm thành công');
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
        $data  = $this->Danhmuc->find($id);
        return view('Admin.Danhmuc.edit',compact('data'));
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
        $validated = $request->validate([
            'name' => 'required',
        ],[
            'name.required'=>'Bạn chưa nhập tên danh mục',
        ]);

        $data = [
            'name'=> $request->name,
            'slug'=>Str::slug($request->name)
        ];

        $this->Danhmuc->update($id,$data);
        
        return redirect('admin123/danhmuc')->with('success','Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->Danhmuc->delete($id);
        return redirect('admin123/danhmuc')->with('success','Xoá thành công');
    }
}
