<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = [
        'name',
        'description',
        'category_id',
        "sku",
        "brand",
        'price',
        'stock',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }
    
    /**
     * Calculate rental price based on duration in days
     *
     * @param int $days
     * @return float
     */
    public function calculateRentalPrice($days)
    {
        // Base price per day
        $basePrice = $this->price;
        
        // Apply discount based on rental duration
        if ($days >= 28) { // 4 weeks
            return $basePrice * $days * 0.7143; // ~29% discount
        } elseif ($days >= 21) { // 3 weeks
            return $basePrice * $days * 0.8476; // ~15% discount
        } elseif ($days >= 14) { // 2 weeks
            return $basePrice * $days * 0.8857; // ~11% discount
        } elseif ($days >= 7) { // 1 week
            return $basePrice * $days * 0.9143; // ~9% discount
        } else {
            return $basePrice * $days; // No discount
        }
    }
    
    /**
     * Format price to Indonesian Rupiah
     *
     * @param float $price
     * @return string
     */
    public function formatPrice($price)
    {
        return 'Rp' . number_format($price, 0, ',', '.');
    }
}
