<?php


namespace App\Repositories\Nhansu;


use App\Models\Admin\NhansuModel;
use App\Repositories\BaseRepository;

class NhansuRepository extends BaseRepository implements NhansuRepositoryInterface
{
    protected $model;

    public function getModel()
    {
        return NhansuModel::class;
    }

    public function getNhansu()
    {
        return $this->model->select('nhansu.*', 'dichvu.tendv')
            ->join('dichvu', 'nhansu.iddv', '=', 'dichvu.id')
            ->get();
    }

    public function CheckEmail($email){
        return $this->model->select('*')->where('email', 'like', '%'. $email. '%')->doesntExist();
    }

    public function editNhansu($id)
    {
        return $this->model->select('nhansu.*', 'nhansu.id','dichvu.tendv')
            ->join('dichvu', 'nhansu.iddv', '=', 'dichvu.id')
            ->where('nhansu.id', $id)
            ->get();
    }
}
