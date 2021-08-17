<?php


namespace App\Repositories\Dichvu;


use App\Models\Dichvu;
use App\Repositories\BaseRepository;

class DichvuRepository extends BaseRepository implements DichvuRepositoryInterface
{
    protected $model;

    public function getModel()
    {
        return Dichvu::class;
    }

    public function getDichvu()
    {
        return $this->model->getAll();
    }
}
