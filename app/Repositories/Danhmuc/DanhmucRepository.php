<?php


namespace App\Repositories\Danhmuc;
use App\Repositories\BaseRepository;
class DanhmucRepository extends BaseRepository implements DanhmucRepositoryInterface
{

    public function getModel(){
        return \App\Models\Admin\DanhMucModel::class;
    }
   
}
