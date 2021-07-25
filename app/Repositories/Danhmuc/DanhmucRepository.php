<?php


namespace App\Repositories\Danhmuc;


use App\Models\DanhMucModel;

class DanhmucRepository implements DanhmucRepositoryInterface
{
    private $model;

    /**
     * DanhmucRepository constructor.
     */
    public function __construct(DanhMucModel $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function create($attributes = [])
    {
        // TODO: Implement create() method.
    }

    public function update($id, $attributes = [])
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
