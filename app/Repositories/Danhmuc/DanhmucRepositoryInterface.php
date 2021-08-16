<?php


namespace App\Repositories\Danhmuc;


interface DanhmucRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function create($attributes = []);

    public function update($id,$attributes = []);

    public function delete($id);

    
}
