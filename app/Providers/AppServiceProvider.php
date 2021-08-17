<?php

namespace App\Providers;

use App\Repositories\Danhmuc\DanhmucRepository;
use App\Repositories\Danhmuc\DanhmucRepositoryInterface;
use App\Repositories\Dichvu\DichvuRepository;
use App\Repositories\Dichvu\DichvuRepositoryInterface;
use App\Repositories\Nhansu\NhansuRepository;
use App\Repositories\Nhansu\NhansuRepositoryInterface;
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
