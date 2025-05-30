<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Review;
use App\Models\Pemesanan;

class ReviewPolicy
{
    public function create(User $user, Pemesanan $pemesanan)
    {
        return $user->id === $pemesanan->user_id && 
               $pemesanan->status === 'completed' && 
               !$pemesanan->review;
    }

    public function delete(User $user, Review $review)
    {
        return $user->id === $review->user_id || $user->isAdmin();
    }
}