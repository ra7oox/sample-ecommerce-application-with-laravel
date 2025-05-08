<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavouriteProduct extends Model
{
    public $table="favourite_products";
    protected $fillable=["client_id","product_id"];
    public function user(){
        return $this->belongsTo(User::class,"client_id");
    }
    public function product(){
        return $this->belongsTo(ProductList::class,"product_id");
    }
}
