<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Transaksi;
use App\Models\Pemesanan;

class TransaksiPolicy
{
    public function view(User $user, Transaksi $transaksi)
    {
        return $user->id === $transaksi->user_id || $user->isAdmin();
    }

    public function create(User $user, Pemesanan $pemesanan)
    {
        return $user->id === $pemesanan->user_id && !$pemesanan->transaksi;
    }

    public function confirm(User $user, Transaksi $transaksi)
    {
        return $user->isAdmin() && $transaksi->status === 'pending';
    }

    public function reject(User $user, Transaksi $transaksi)
    {
        return $user->isAdmin() && $transaksi->status === 'pending';
    }
}
