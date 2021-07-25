<?php

namespace App\Providers;

use App\Repositories\Danhmuc\DanhmucRepository;
use App\Repositories\Danhmuc\DanhmucRepositoryInterface;
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
