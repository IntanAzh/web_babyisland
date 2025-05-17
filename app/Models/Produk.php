<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = [
        'user_id', 
        'kategori_id', 
        'nama', 
        'deskripsi', 
        'harga_perhari', 
        'stok', 
        'gambar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }
}