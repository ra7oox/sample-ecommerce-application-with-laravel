<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table="categories";
    protected $fillable=["category_name"];
    public function products(){
        return $this->hasMany(ProductList::class,'category_id');
    }
    public function subcategory(){
        return $this->hasMany(Subcategory::class,"category_id");
    }
}
