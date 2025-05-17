<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Users as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
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
        'no_hp', 
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
