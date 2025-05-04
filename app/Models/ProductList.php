<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    public $table="product_lists";
    protected $fillable=["name","description","quantity","image","price","category_id"];
    public function category(){
        return $this->belongsTo(Category::class,"category_id");
    }
}
