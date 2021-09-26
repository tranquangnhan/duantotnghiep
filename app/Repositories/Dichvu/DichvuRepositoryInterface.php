<?php


namespace App\Repositories\Dichvu;


use App\Repositories\RepositoryInterface;

interface DichvuRepositoryInterface extends RepositoryInterface
{
public function getDichVu();
public function editDichvu($id);
}
