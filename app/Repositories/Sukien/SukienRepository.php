<?php


namespace App\Repositories\Sukien;

use App\Models\Admin\SuKienModel;
use App\Repositories\BaseRepository;

class SukienRepository extends BaseRepository implements SukienRepositoryInterface
{
    protected $model;

    public function getModel()
    {
        return SuKienModel::class;
    }

    public function updateTrangThaiXinNghi($id, $trangThai) {
        return $this->model::find($id)->update([
            'trangthai' => $trangThai,
        ]);
    }

}
