<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'table_siswa';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nis',
        'nik',
        'nama_lengkap',
        'kelas',
        'jurusan',
        'alamat',
        'no_hp',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Tambahkan relasi ke pendaftaran
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'siswa_id');
    }

    // Cek apakah sudah memiliki PKL aktif
    public function hasActivePKL()
    {
        return $this->pendaftaran()
            ->where('status', 'diterima')
            ->whereNotNull('tanggal_berlaku')
            ->where('tanggal_berlaku', '>', now())
            ->exists();
    }

    // Get PKL aktif
    public function getActivePKL()
    {
        return $this->pendaftaran()
            ->where('status', 'diterima')
            ->whereNotNull('tanggal_berlaku')
            ->where('tanggal_berlaku', '>', now())
            ->first();
    }

    // Cek apakah sedang menunggu persetujuan
    public function hasPendingRegistration()
    {
        return $this->pendaftaran()
            ->where('status', 'menunggu')
            ->exists();
    }
}