<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    public $table="product_carts";
    protected $fillable=["product_id","client_id","quantity","address","paiment_method"];
    public function user(){
        return $this->belongsTo(User::class,"client_id");
    }
    public function product(){
        return $this->belongsTo(ProductList::class,"product_id");
    }
}
