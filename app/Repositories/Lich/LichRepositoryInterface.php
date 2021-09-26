<?php


namespace App\Repositories\Lich;


use App\Repositories\RepositoryInterface;

interface LichRepositoryInterface extends RepositoryInterface
{
    public function getLichlam($id);
}
