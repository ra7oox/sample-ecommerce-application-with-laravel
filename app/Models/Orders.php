<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public $table="orders";
    protected $fillable=["product_id","client_id","address","payment_method","quantity","status"];
    public function user(){
        return $this->belongsTo(User::class,"client_id");
        
    }
    public function product(){
        return $this->belongsTo(ProductList::class,"product_id");
        
    }
}
