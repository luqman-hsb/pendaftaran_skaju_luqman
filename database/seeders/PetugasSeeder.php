<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        Petugas::create([
            'nama_lengkap' => 'Administrator',
            'jabatan' => 'Super Admin',
            'email' => 'admin@sekolah.sch.id',
            'password' => Hash::make('password123'),
            'is_superadmin' => true,
        ]);

        Petugas::create([
            'nama_lengkap' => 'Petugas PKL',
            'jabatan' => 'Koordinator PKL',
            'email' => 'pkl@sekolah.sch.id',
            'password' => Hash::make('password123'),
            'is_superadmin' => false,
        ]);
    }
}