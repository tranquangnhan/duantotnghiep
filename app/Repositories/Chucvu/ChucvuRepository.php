<?php


namespace App\Repositories\Chucvu;
use App\Repositories\BaseRepository;
class ChucvuRepository extends BaseRepository implements ChucvuRepositoryInterface
{
    public function getModel(){
        return \App\Models\Admin\ChucVuModel::class;
    }
}
