<?php


namespace App\Repositories\Sukien;

interface SukienRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function create($attributes = []);

    public function update($id,$attributes = []);

    public function delete($id);

    public function updateTrangThaiXinNghi($id, $trangThai);
}
