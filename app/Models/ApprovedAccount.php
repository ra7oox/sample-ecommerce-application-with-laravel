<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApprovedAccount extends Model
{
    public $table='approved_accounts';
    protected $fillable=["user_email","approved"];
}
