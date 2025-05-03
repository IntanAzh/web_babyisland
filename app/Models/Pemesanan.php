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
    protected $table = 'pemesanan';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_order';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomor_hp',
        'alamat',
        'waktu_pinjam',
        'waktu_kembali',
        'total',
        'id_produk',
        'id_kategori',
    ];

    /**
     * Get the produk associated with the order.
     */
    public function produk()
    {
        return $this->belongsTo(produk::class, 'id_produk');
    }

    /**
     * Get the category associated with the order.
     */
    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'id_kategori');
    }

    /**
     * Get the transaksi for the order.
     */
    public function transaksi()
    {
        return $this->hasOne(transaksi::class, 'id_order');
    }
}
