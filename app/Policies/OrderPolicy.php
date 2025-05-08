<?php

namespace App\Policies;

use App\Models\User;

class OrderPolicy
{
    public function create(?User $user)
    {
        return is_null($user) || $user->account_type === 'client';
    }
    
    public function gerer(User $user){

        return $user->account_type=="admin" || $user->account_type=="seller";
    }
}
