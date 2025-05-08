<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    public $table="product_lists";
    protected $fillable=["name","description","quantity","image","price","category_id","seller_id","subcategory_id"];
    public function category(){
        return $this->belongsTo(Category::class,"category_id");
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class,"subcategory_id");
    }
    public function user(){
        return $this->belongsTo(User::class,"seller_id");
    }
    public function order(){
        return $this->hasMany(Orders::class,"product_id");
        
    }
    public function favourites(){
        return $this->hasMany(FavouriteProduct::class);
    }
    public function reviews(){
        return $this->hasMany(ProductReview::class,"product_id");

    }
}
