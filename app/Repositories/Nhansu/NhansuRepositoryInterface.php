<?php


namespace App\Repositories\Nhansu;


use App\Repositories\RepositoryInterface;

interface NhansuRepositoryInterface extends RepositoryInterface
{
public function getNhansu();
public function CheckEmail($email);
public function editNhansu($id);
public function getDetailNhanSu($id);
}
