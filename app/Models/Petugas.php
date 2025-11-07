<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Petugas extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'table_petugas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_lengkap',
        'jabatan',
        'email',
        'password',
        'is_superadmin'
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_superadmin' => 'boolean',
        ];
    }

    // Relasi ke pendaftaran yang ditangani
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'petugas_id');
    }
}