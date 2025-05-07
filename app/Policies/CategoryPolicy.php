<?php

namespace App\Policies;

use App\Models\User;

class CategoryPolicy
{
    public function create(User $user){
        return $user->account_type=="admin";
    }
    public function update(User $user){
        return $user->account_type=="admin";
    }
    public function delete(User $user){
        return $user->account_type=="admin";
    }
}
