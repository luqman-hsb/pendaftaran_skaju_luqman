<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'table_pendaftaran';

    protected $fillable = [
        'siswa_id',
        'iduka_id',
        'petugas_id',
        'tanggal_daftar',
        'tanggal_berlaku',
        'status',
        'catatan_penolakan'
    ];

    protected $casts = [
        'tanggal_daftar' => 'date',
        'tanggal_berlaku' => 'date',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function iduka()
    {
        return $this->belongsTo(Iduka::class, 'iduka_id');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }
}
