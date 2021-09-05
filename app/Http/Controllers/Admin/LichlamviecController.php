<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lich;
use App\Repositories\Coso\CosoRepositoryInterface;
use App\Repositories\Lich\LichRepositoryInterface;
use Illuminate\Http\Request;

class LichlamviecController extends Controller
{
    protected $lich;
    protected $coso;

    public function __construct(LichRepositoryInterface $lich, CosoRepositoryInterface $coso)
    {
        $this->lich = $lich;
        $this->coso = $coso;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->coso->getAll();

        return view('Admin.Lichlamviec.lichlamviec',compact('data'));
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->lich->getLichlam($id);
        $nameCs=$this->coso->find($id);
        return view('Admin.Lichlamviec.ngaylam',compact('nameCs', 'data'));
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
    public function update(Lich $request, $id)
    {

        $type=$request->type;
        if ($type==null){
            $type=0;
        }
        else{
            $type=1;
        }

        if ($request->soluongkh>=1){
            $lich=[
                'soluongkhach'=>$request->soluongkh,
                'giobatdau'=>$request->giobatdau,
                'gioketthuc'=>$request->gioketthuc,
                'type'=>$type,
                'ghichu'=>$request->ghichu
            ];
            $this->lich->update($id, $lich);
            echo 1;
            return redirect(route('lichlamviec.show', $request->idcoso))->with('thanhcong', 'Sửa lịch làm thành công');
        } else {
            return redirect(route('lichlamviec.show', $request->idcoso))->with('thatbai', 'Sửa lịch làm thất bại');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
