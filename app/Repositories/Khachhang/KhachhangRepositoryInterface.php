<?php


namespace App\Repositories\Khachhang;


use App\Repositories\RepositoryInterface;

interface KhachhangRepositoryInterface extends RepositoryInterface
{
public function getKhachHang();
public function editKhachHang($id);
}
