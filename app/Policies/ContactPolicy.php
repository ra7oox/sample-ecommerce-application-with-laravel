<?php

namespace App\Policies;

use App\Models\User;

class ContactPolicy
{
    public function show(User $user){
        return $user->account_type=="admin";
    }
    public function create(User $user){
        return $user->account_type=="client" || $user->account_type=="seller";
    }
    public function reply(User $user){
        return $user->account_type=="admin";
    }
}
