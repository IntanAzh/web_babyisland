<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'username',
        'email',
        'password',
        'phonenumber',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Relasi ke pemesanan
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Cek role admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
