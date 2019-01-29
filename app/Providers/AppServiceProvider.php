<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(150);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\VendorsRepositoyInterface::class, \App\Repositories\VendorsRepository::class
        );

        $this->app->bind(
            \App\Repositories\StoreRepositoryInterface::class, \App\Repositories\StoreRepository::class
        );
    }
}
