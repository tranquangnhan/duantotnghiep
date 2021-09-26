<?php


namespace App\Repositories\Donhang;
use App\Repositories\BaseRepository;
class DonhangRepository extends BaseRepository implements DonhangRepositoryInterface
{

    public function getModel(){
        return \App\Models\Admin\DonhangModel::class;
    }

}
