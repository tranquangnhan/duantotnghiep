<?php


namespace App\Repositories\SuKien;


interface SuKienRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function create($attributes = []);

    public function update($id,$attributes = []);

    public function delete($id);
}
