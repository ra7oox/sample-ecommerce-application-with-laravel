<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    public $table='subcategories';
    protected $fillable=["category_id","subcategory_name"];
    public function category(){
        return $this->belongsTo(Category::class,"category_id");
    }
}
