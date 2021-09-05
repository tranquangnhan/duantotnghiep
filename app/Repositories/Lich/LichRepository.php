<?php


namespace App\Repositories\Lich;


use App\Models\Admin\Lichlamviec;
use App\Repositories\BaseRepository;

class LichRepository extends BaseRepository implements LichRepositoryInterface
{
    protected $model;

    public function getModel()
    {
        return Lichlamviec::class;
    }

    public function getLichlam($id){
        return $this->model->select('*')->where('idcoso', '=', $id )->get();
    }

}
