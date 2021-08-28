<?php


namespace App\Repositories\SuKien;
use App\Repositories\BaseRepository;
class ChamcongRepository extends BaseRepository implements SuKienRepositoryInterface
{

    public function getModel(){
        return \App\Models\Admin\SuKienModel::class;
    }

}
