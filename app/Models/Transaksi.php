<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;

    protected $fillable = [
        'id_order',
        'id_user',
        'pembayaran',
        'status',
        'dibuat',
    ];

    protected $dates = ['dibuat'];

    public function order()
    {
        return $this->belongsTo(Pemesanan::class, 'id_order');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
