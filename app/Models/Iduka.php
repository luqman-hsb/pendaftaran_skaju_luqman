<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iduka extends Model
{
    use HasFactory;

    protected $table = 'table_iduka';

    protected $fillable = [
        'nama_iduka',
        'alamat',
        'bidang_usaha',
        'kontak_person',
        'no_telp',
        'email',
        'kuota'
    ];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'iduka_id');
    }
}
