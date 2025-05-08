<?php

namespace App\Policies;

use App\Models\ProductReview;
use App\Models\User;

class ReviewsPolicy
{
    public function create(User $user){
        return $user->account_type=="client";
    }
    public function update(User $user,ProductReview $review){
        return $review->client_id==$user->id;
    }
    public function delete(User $user,ProductReview $review){
        return $review->client_id==$user->id;

    }
    public function show(User $user){
        return $user->account_type=="seller";
    }
}
