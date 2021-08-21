<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use App\Models\Admin\Province;
use App\Models\Admin\Wards;
use App\Models\Admin\CosoModel;
use App\Repositories\Coso\CosoRepository;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CosoController extends Controller
{
    private $Coso;
    /**
     * CosoController constructor.
     */
    public function __construct(CosoRepository $Coso)
    {
        $this->Coso = $Coso;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->Coso->getAll();
        // $data1 = $this->Coso->getAll();
        // $data = CosoModel::orderby('id','DESC')->get();
        $city= City::orderBy('matp', 'ASC')->select('matp','name_city')->get();
        $province= Province::orderBy('maqh', 'ASC')->select('maqh','name_quanhuyen')->get();
        $wards= Wards::orderBy('xaid', 'ASC')->select('xaid','name_xaphuong')->get();

       return view('Admin.Coso.index',compact('data','city','province','wards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = City::orderby('matp','ASC')->get();
        return view('Admin.Coso.create')->with('city',$city);
    }
    public function select_dellivery(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                    $output.='<option>---Chọn quận huyện---</option>';
                foreach($select_province as $key => $province){

                    $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }


            }else{
                $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output.='<option>---Chọn xã phường---</option>';
                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
                }
            }
            echo $output;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_dellivery(Request $request)
    {
        // $validated = $request->validate([
        //     'name' => 'required',
        // ],[
        //     'name.required'=>'Bạn chưa nhập tên danh mục',

        // ]);

        $data = $request->all();
        $free = new CosoModel();
        $free->name = $data['name'];
        $free->tinh = $data['city'];
        $free->quanhuyen = $data['province'];
        $free->diachi = $data['wards'];
        $free->save();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    $data  = $this->Coso->find($id);
    $city = City::orderby('matp','ASC')->get();
    $province= Province::orderBy('maqh', 'ASC')->get();
    $wards= Wards::orderBy('xaid', 'ASC')->get();
    return view('Admin.coso.edit',compact('data','city','province','wards'));

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



        $data = [
            'name'=> $request->name,
            'tinh'=>$request->city,
            'quanhuyen'=>$request->province,
            'diachi'=>$request->wards
        ];

       $this->Coso->update($id,$data);



        return redirect('quantri/coso')->with('success','Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->Coso->delete($id);
        return redirect('quantri/coso')->with('success','Xoá thành công');
        // if ($id > 0){
        //     $this->Coso->delete($id);
        // }
    //  return response()->json([
    //    'title' => 'Đã xóa!',
    //    'text' => 'Cơ sở id' . $id . 'đã xóa thành công',
    //    'status' => 'success!',
    //  ]);

    }
}
