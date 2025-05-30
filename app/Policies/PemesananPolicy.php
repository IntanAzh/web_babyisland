<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Pemesanan;

class PemesananPolicy
{
    public function view(User $user, Pemesanan $pemesanan)
    {
        return $user->id === $pemesanan->user_id || $user->isAdmin();
    }

    public function cancel(User $user, Pemesanan $pemesanan)
    {
        return $user->id === $pemesanan->user_id && $pemesanan->status === 'pending';
    }

    public function update(User $user, Pemesanan $pemesanan)
    {
        return $user->isAdmin();
    }
}