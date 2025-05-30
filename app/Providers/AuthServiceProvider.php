<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Pemesanan;
use App\Models\Transaksi;
use App\Models\Review;
use App\Policies\PemesananPolicy;
use App\Policies\TransaksiPolicy;
use App\Policies\ReviewPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Pemesanan::class => PemesananPolicy::class,
        Transaksi::class => TransaksiPolicy::class,
        Review::class => ReviewPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}