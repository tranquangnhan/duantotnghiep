<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Danhmuc\DanhmucRepository;
use App\Http\Requests\DanhMuc;
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
    public function store(DanhMuc $request)
    {
        $validated = $request->validated();

        $data = [
            'name'=> $request->name,
            'slug'=>Str::slug($request->name)
        ];

        $this->Danhmuc->create($data);
        
        return redirect('quantri/danhmuc')->with('success','Thêm thành công');
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
    public function update(DanhMuc $request, $id)
    {
        $validated = $request->validated();

        $data = [
            'name'=> $request->name,
            'slug'=>Str::slug($request->name)
        ];

        $this->Danhmuc->update($id,$data);
        
        return redirect('quantri/danhmuc')->with('success','Sửa thành công');
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
        return redirect('quantri/danhmuc')->with('success','Xoá thành công');
    }
}
