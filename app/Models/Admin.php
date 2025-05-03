<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'admin';

    // Primary key custom
    protected $primaryKey = 'id_admin';

    // Aktifkan timestamps (created_at & updated_at)
    public $timestamps = true;

    // Field yang boleh di mass assignment
    protected $fillable = [
        'username',
        'password',
    ];

    // Sembunyikan password saat model diubah ke array/JSON
    protected $hidden = [
        'password',
    ];

    /**
     * Mutator: otomatis hash password saat diset.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
