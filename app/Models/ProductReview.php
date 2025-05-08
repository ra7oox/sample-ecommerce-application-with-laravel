<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    public $table="product_reviews";
    protected $fillable=["client_id","product_id","review"];
    public function client(){
        return $this->belongsTo(User::class,"client_id");
    }
    public function product(){
        return $this->belongsTo(ProductList::class,"product_id");
    }
}
