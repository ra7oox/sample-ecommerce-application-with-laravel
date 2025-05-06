<?php

namespace App\Providers;

use App\Policies\OrderPolicy;
use App\Policies\ProductsPolicy;
use App\Policies\UsersPolicy;
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

        Gate::define("show-user",[UsersPolicy::class,'show']);
        Gate::define("create-user",[UsersPolicy::class,'create']);
        Gate::define("update-user",[UsersPolicy::class,'update']);
        Gate::define("delete-user",[UsersPolicy::class,'delete']);

        Gate::define("create-order",[OrderPolicy::class,'create']);
        Gate::define("gerer-order",[OrderPolicy::class,'gerer']);





    }
}
