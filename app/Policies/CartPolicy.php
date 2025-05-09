<?php

namespace App\Policies;

use App\Models\ProductCart;
use App\Models\User;

class CartPolicy
{
    public function show(User $user){
        return $user->account_type=="client";
    }
    public function create(User $user){
        return $user->account_type=="client";
    }
    public function delete(User $user,ProductCart $cart){
        return $user->id==$cart->client_id;
    }
}
