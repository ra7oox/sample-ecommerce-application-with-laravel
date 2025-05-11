<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $table='contacts';
    protected $fillable=["user_id","message"];
    public function user(){
        return $this->belongsTo(User::class,"user_id");

    }
}
