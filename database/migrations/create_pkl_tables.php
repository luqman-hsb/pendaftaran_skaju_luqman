<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        // === TABLE PETUGAS ===
        Schema::create('table_petugas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('jabatan')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_superadmin')->default(false);
            $table->timestamps();
        });

        // === TABLE SISWA ===
        Schema::create('table_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nis', 20)->unique();
            $table->string('nik', 20)->unique();
            $table->string('nama_lengkap');
            $table->string('kelas')->nullable();
            $table->string('jurusan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_hp', 50)->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->timestamps();
        });

        // === TABLE IDUKA ===
        Schema::create('table_iduka', function (Blueprint $table) {
            $table->id();
            $table->string('nama_iduka');
            $table->text('alamat');
            $table->string('bidang_usaha');
            $table->string('kontak_person')->nullable();
            $table->string('no_telp', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->integer('kuota')->default(0);
            $table->timestamps();
        });

        // === TABLE PENDAFTARAN ===
        Schema::create('table_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('table_siswa')->cascadeOnDelete();
            $table->foreignId('iduka_id')->constrained('table_iduka')->cascadeOnDelete();
            $table->foreignId('petugas_id')->nullable()->constrained('table_petugas')->nullOnDelete();
            $table->date('tanggal_daftar');
            $table->date('tanggal_berlaku')->nullable();
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->text('catatan_penolakan')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_pendaftaran');
        Schema::dropIfExists('table_iduka');
        Schema::dropIfExists('table_siswa');
        Schema::dropIfExists('table_petugas');
    }
};
