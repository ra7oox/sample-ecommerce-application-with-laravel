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
    }else{
        return view("dashboard-seller");

    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource("products",ProductListController::class);
    Route::resource("categories",CategoryController::class);
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


});




Route::redirect("/","/login");
require __DIR__.'/auth.php';
