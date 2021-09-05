<?php


namespace App\Repositories\Khachhang;

use App\Models\Admin\KhachHangModel;
use App\Repositories\BaseRepository;

class KhachhangRepository extends BaseRepository implements KhachhangRepositoryInterface
{
    protected $model;

    public function getModel()
    {
        return KhachHangModel::class;
    }

    public function getKhachHang()
    {
        return $this->model->select('khachhang.*')
        ->get();
    }

    public function editKhachHang($id)
    {
        return $this->model->select('khachhang.*', 'khachhang.id')
            ->where('khachhang.id', $id)
            ->get();
    }
}
