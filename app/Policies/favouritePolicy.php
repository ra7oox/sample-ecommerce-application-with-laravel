<?php

namespace App\Policies;

use App\Models\FavouriteProduct;
use App\Models\User;

class FavouritePolicy
{
   public function show(User $user){
    return $user->account_type=="client" ;
   }
   public function create(User $user){
    return $user->account_type=="client";
   }
   public function delete(User $user, FavouriteProduct $favourite) {
    return $user->id === $favourite->client_id;
}

}
