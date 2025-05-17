<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemesanan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = [
        'user_id', 
        'produk_id', 
        'qty', 
        'tanggal_mulai',
        'tanggal_berakhir', 
        'total_harga', 
        'alamat', 
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Diubah dari Users ke User
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class);
    }
}
