<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kategori extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = [
        'nama', 
        'gambar'
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
