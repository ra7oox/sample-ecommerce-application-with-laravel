<?php

namespace App\Providers;

use App\Models\FavouriteProduct;
use App\Policies\CategoryPolicy;
use App\Policies\FavouritePolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProductsPolicy;
use App\Policies\ReviewsPolicy;
use App\Policies\subcategoryPolicy;
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


        Gate::define("create-category",[CategoryPolicy::class,'create']);
        Gate::define("update-category",[CategoryPolicy::class,'update']);
        Gate::define("delete-category",[CategoryPolicy::class,'delete']);

        Gate::define("create-subcategory",[subcategoryPolicy::class,'create']);
        Gate::define("update-subcategory",[subcategoryPolicy::class,'update']);
        Gate::define("delete-subcategory",[subcategoryPolicy::class,'delete']);


        Gate::define("show-favourites",[FavouritePolicy::class,'show']);
        Gate::define("create-favourites",[FavouritePolicy::class,'create']);
        Gate::define("delete-favourites",[FavouritePolicy::class,'delete']);


        Gate::define("show-review",[ReviewsPolicy::class,"show"]);
        Gate::define("create-review",[ReviewsPolicy::class,"create"]);
        Gate::define("update-review",[ReviewsPolicy::class,"update"]);
        Gate::define("delete-review",[ReviewsPolicy::class,"delete"]);

    }
}
