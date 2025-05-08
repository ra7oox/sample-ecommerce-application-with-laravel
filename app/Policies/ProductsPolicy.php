<?php

namespace App\Policies;

use App\Models\ProductList;
use App\Models\User;

class ProductsPolicy
{
   public function create(User $user){
    return $user->account_type=="admin" || $user->account_type=="seller";

   }
   public function update(User $user, ProductList $product)
{
    return $user->account_type === 'admin' || $product->seller_id === $user->id;
}

   public function delete(User $user){
    return $user->account_type=="admin";

   }
}
