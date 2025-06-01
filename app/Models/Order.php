<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'qty',
        'start_date',
        'end_date',
        'total_price',
        'address',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Diubah dari Users ke User
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
