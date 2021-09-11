<?php


namespace App\Repositories\Coso;
use App\Repositories\BaseRepository;
class CosoRepository extends BaseRepository implements CosoRepositoryInterface
{

    public function getModel(){
        return \App\Models\Admin\CosoModel::class;
    }
    // public function modelcity(){
    //     return \App\Models\Admin\City::class;
    // }

}
