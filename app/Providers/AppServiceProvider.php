<?php

namespace App\Providers;

use App\Policies\ProductsPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define("create-product",[ProductsPolicy::class,'create']);
        Gate::define("update-product",[ProductsPolicy::class,'update']);
        Gate::define("delete-product",[ProductsPolicy::class,'delete']);

    }
}
