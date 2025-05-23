<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'account_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function products(){
        return $this->hasMany(ProductList::class,"seller_id");
    }
    public function orders(){
        return $this->hasMany(Orders::class,"client_id");
        
    }
    public function favourites(){
        return $this->hasMany(FavouriteProduct::class);
    }
    public function reviews(){
        return $this->hasMany(ProductReview::class,"client_id");

    }
    public function carts(){
        return $this->hasMany(ProductCart::class,"client_id");

    }
    public function contacts(){
        return $this->hasMany(Contact::class,"user_id");

    }
}
