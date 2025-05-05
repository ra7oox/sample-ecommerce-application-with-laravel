<?php

namespace App\Policies;

use App\Models\User;

class ProductsPolicy
{
   public function create(User $user){
    return $user->account_type=="admin" || $user->account_type=="seller";

   }
   public function update(User $user){
    return $user->account_type=="admin";

   }
   public function delete(User $user){
    return $user->account_type=="admin";

   }
}
