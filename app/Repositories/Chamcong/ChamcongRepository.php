<?php


namespace App\Repositories\Chamcong;
use App\Repositories\BaseRepository;
class ChamcongRepository extends BaseRepository implements ChamcongRepositoryInterface
{
    protected $model;

    public function getModel(){
        return \App\Models\Admin\ChamcongModel::class;
    }
    
    public function getChamCongByIdUser($idUser){
        $today = date("Y-m-d");
        return  $this->model->where('idns', $idUser)
        ->where('ngay', '=', $today)
        ->orderByDesc('id')
        ->first();
    }

}
