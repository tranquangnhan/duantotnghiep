<?php

namespace App\Providers;

use App\Repositories\Coso\CosoRepository;
use App\Repositories\Coso\CosoRepositoryInterface;
use App\Repositories\Danhmuc\DanhmucRepository;
use App\Repositories\Danhmuc\DanhmucRepositoryInterface;
use App\Repositories\Dichvu\DichvuRepository;
use App\Repositories\Dichvu\DichvuRepositoryInterface;
use App\Repositories\Lich\LichRepository;
use App\Repositories\Lich\LichRepositoryInterface;
use App\Repositories\Nhansu\NhansuRepository;
use App\Repositories\Nhansu\NhansuRepositoryInterface;
use App\Repositories\Sukien\SukienRepository;
use App\Repositories\Sukien\SukienRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DanhmucRepositoryInterface::class,DanhmucRepository::class);
        $this->app->singleton(NhansuRepositoryInterface::class,NhansuRepository::class);
        $this->app->singleton(DichvuRepositoryInterface::class,DichvuRepository::class);
        $this->app->singleton(SukienRepositoryInterface::class,SukienRepository::class);
        $this->app->singleton(LichRepositoryInterface::class,LichRepository::class);
        $this->app->singleton(CosoRepositoryInterface::class,CosoRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
