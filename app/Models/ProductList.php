<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    public $table="product_lists";
    protected $fillable=["name","description","quantity","image","price","category_id","seller_id"];
    public function category(){
        return $this->belongsTo(Category::class,"category_id");
    }
    public function user(){
        return $this->belongsTo(User::class,"seller_id");
    }
}
