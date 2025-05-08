<?php

use App\Http\Controllers\ApprovedAccountController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavouriteProductController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UsersController;
use App\Models\FavouriteProduct;
use App\Models\ProductList;
use Illuminate\Support\Facades\Auth;

Route::get('/dashboard', function () {
    if(Auth::user()->account_type=="admin"){
        return view("dashboard-admin");
    }elseif(Auth::user()->account_type=="client"){
        return view("dashboard-client");
    }else{
        return view("dashboard-seller");

    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource("categories",CategoryController::class);
    Route::resource("orders",OrdersController::class);
    Route::resource("subcategories",SubcategoryController::class);
    Route::resource("favourites",FavouriteProductController::class);
    Route::match(['get', 'post'], '/add-favourite/{product_id}', [FavouriteProductController::class, 'addFavourite'])->name('favourites.add');


// web.php (routes)
Route::get('/subcategory/{categoryId}', [SubcategoryController::class, 'getSubcategories']);

    Route::get("/lastproducts",function(){
        if (Auth::user()->account_type == "admin" || Auth::user()->account_type == "client") {
            $products = ProductList::latest()->get();
        } else {
            $products = Auth::user()->products()->latest()->get(); // Note le () pour builder
        }
        return view("layouts.acceuil",compact("products"));
    })->name("last-products");
    Route::match(['get', 'post'], '/products/search', [ProductListController::class, 'search'])->name('products.search');
    Route::resource("users",UsersController::class);
    Route::patch('/orders/{order}/update-status', [OrdersController::class, 'updateStatus'])->name('orders.updateStatus');
Route::patch('/orders/{order}/cancel', [OrdersController::class, 'cancel'])->name('orders.cancel');
Route::get("/approved/{id}",[ApprovedAccountController::class,"approve"])->name("account.approve");
Route::get("/decline/{id}",[ApprovedAccountController::class,"decline"])->name("account.decline");



});


Route::resource("products",ProductListController::class);


Route::redirect("/","/products");
require __DIR__.'/auth.php';
