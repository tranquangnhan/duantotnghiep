<?php


namespace App\Repositories\Chamcong;
use App\Repositories\BaseRepository;
class ChamcongRepository extends BaseRepository implements ChamcongRepositoryInterface
{

    public function getModel(){
        return \App\Models\Admin\ChamcongModel::class;
    }

}
