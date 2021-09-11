<?php


namespace App\Repositories\Chucvu;

interface ChucvuRepositoryInterface 
{
    public function getAll();

    public function find($id);

    public function create($attributes = []);

    public function update($id,$attributes = []);

    public function delete($id);
}
