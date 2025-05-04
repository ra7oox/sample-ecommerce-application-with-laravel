<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table="categories";
    public function products(){
        return $this->hasMany(ProductList::class,'category_id');
    }
}
