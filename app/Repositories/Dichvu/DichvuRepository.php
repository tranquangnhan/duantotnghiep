<?php


namespace App\Repositories\Dichvu;

use App\Models\Admin\DichvuModel;
use App\Repositories\BaseRepository;

class DichvuRepository extends BaseRepository implements DichvuRepositoryInterface
{
    protected $model;

    public function getModel()
    {
        return DichvuModel::class;
    }

    public function getDichVu()
    {
        return $this->model->select('dichvu.*', 'danhmuc.name')
        ->join('danhmuc', 'dichvu.iddm', '=', 'danhmuc.id')
        ->get();
    }

    public function editDichvu($id)
    {
        return $this->model->select('dichvu.*', 'dichvu.id','danhmuc.name')
            ->join('danhmuc', 'dichvu.iddm', '=', 'danhmuc.id')
            ->where('dichvu.id', $id)
            ->get();
    }
}
