<?php


namespace App\Repositories\Chamcong;


interface ChamcongRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function create($attributes = []);

    public function update($id,$attributes = []);

    public function delete($id);
}
