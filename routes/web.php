<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\UsersController;
use App\Models\ProductList;
use Illuminate\Support\Facades\Auth;

Route::get('/dashboard', function () {
    if(Auth::user()->account_type=="admin"){
        return view("dashboard-admin");
    }elseif(Auth::user()->account_type=="client"){
        return view("dashboard-client");
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource("products",ProductListController::class);
    Route::resource("categories",CategoryController::class);
    Route::get("/lastproducts",function(){
        $products=ProductList::latest()->get();
        return view("layouts.acceuil",compact("products"));
    })->name("last-products");
    Route::match(['get', 'post'], '/products/search', [ProductListController::class, 'search'])->name('products.search');
    Route::resource("users",UsersController::class);


});




Route::redirect("/","/login");
require __DIR__.'/auth.php';
