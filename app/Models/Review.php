<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'review';

    // Primary key
    protected $primaryKey = 'id_review';

    // Tidak memakai created_at dan updated_at default
    public $timestamps = false;

    // Mass assignable fields
    protected $fillable = [
        'id_user',
        'id_produk',
        'comment',
        'dibuat',
    ];

    // Kolom tanggal kustom
    protected $dates = ['dibuat'];

    /**
     * Relasi: Review ini dimiliki oleh satu User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relasi: Review ini terkait dengan satu Produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}

