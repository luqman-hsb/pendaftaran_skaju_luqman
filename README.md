# Pendaftaran PKL SKAJU

## Gambaran Umum

Pendaftaran PKL SKAJU adalah aplikasi berbasis web yang dibangun dengan Laravel untuk mengelola pendaftaran praktik kerja lapangan (PKL) siswa di SMK SKAJU. Sistem ini memungkinkan siswa mendaftar magang di mitra industri (IDUKA), sementara administrator dan petugas mengelola siswa, IDUKA, dan persetujuan pendaftaran.

## Fitur

-   **Pendaftaran Siswa**: Siswa dapat membuat akun, melihat IDUKA yang tersedia, dan mengirimkan formulir pendaftaran PKL.
-   **Dashboard Admin**: Petugas dapat mengelola siswa, IDUKA, dan meninjau/menyetujui/menolak pendaftaran PKL.
-   **Akses Berbasis Peran**: Otentikasi terpisah untuk siswa dan petugas, dengan hak superadmin untuk mengelola petugas.
-   **Manajemen Profil**: Siswa dapat memperbarui profil mereka.
-   **Riwayat Pendaftaran**: Siswa dapat melihat riwayat pendaftaran PKL mereka.

## Teknologi yang Digunakan

-   **Framework**: Laravel 10
-   **Database**: MySQL (atau kompatibel dengan migrasi database agnostic Laravel)
-   **Frontend**: Template Blade dengan Bootstrap (via Vite untuk kompilasi aset)
-   **Otentikasi**: Laravel Sanctum untuk API, guard kustom untuk siswa dan petugas
-   **Lainnya**: Composer untuk manajemen dependensi, PHPUnit untuk pengujian

## Instalasi

1. Kloning repositori:

    ```
    git clone git@github.com:luqman-hsb/pendaftaran_skaju_luqman.git
    cd pendaftaran-pkl-skaju
    ```

2. Instal dependensi:

    ```
    composer install
    npm install
    ```

3. Siapkan environment:

    - Salin `.env.example` ke `.env`
    - Konfigurasi pengaturan database di `.env`
    - Generate kunci aplikasi: `php artisan key:generate`

4. Jalankan migrasi dan seeder:

    ```
    php artisan migrate
    php artisan db:seed
    ```

5. Kompilasi aset:

    ```
    npm run build
    ```

6. Jalankan server development:
    ```
    php artisan serve
    ```

## Struktur Database

Aplikasi menggunakan tabel database berikut:

### table_petugas (Petugas)

-   `id` (primary key)
-   `nama_lengkap` (string)
-   `jabatan` (string, nullable)
-   `email` (string, unique)
-   `password` (string)
-   `is_superadmin` (boolean, default false)
-   `timestamps`

### table_siswa (Siswa)

-   `id` (primary key)
-   `nis` (string, 20, unique)
-   `nik` (string, 20, unique)
-   `nama_lengkap` (string)
-   `kelas` (string, nullable)
-   `jurusan` (string, nullable)
-   `alamat` (text, nullable)
-   `no_hp` (string, 50, nullable)
-   `email` (string, unique, nullable)
-   `password` (string)
-   `timestamps`

### table_iduka (Mitra Industri)

-   `id` (primary key)
-   `nama_iduka` (string)
-   `alamat` (text)
-   `bidang_usaha` (string)
-   `kontak_person` (string, nullable)
-   `no_telp` (string, 50, nullable)
-   `email` (string, 100, nullable)
-   `kuota` (integer, default 0)
-   `timestamps`

### table_pendaftaran (Pendaftaran)

-   `id` (primary key)
-   `siswa_id` (foreign key ke table_siswa, cascade on delete)
-   `iduka_id` (foreign key ke table_iduka, cascade on delete)
-   `petugas_id` (foreign key ke table_petugas, nullable, null on delete)
-   `tanggal_daftar` (date)
-   `tanggal_berlaku` (date, nullable)
-   `status` (enum: 'menunggu', 'diterima', 'ditolak', default 'menunggu')
-   `catatan_penolakan` (text, nullable)
-   `timestamps`

## Data Dummy

Aplikasi menyertakan seeder untuk data awal:

### Petugas Seeder

-   Administrator (Super Admin): email `admin@sekolah.sch.id`, password `password123`
-   Petugas PKL (Koordinator PKL): email `pkl@sekolah.sch.id`, password `password123`

Untuk menjalankan seeder:

```
php artisan db:seed --class=PetugasSeeder
```

## Rute

### Rute Siswa

-   `/` - Halaman login
-   `/login` - Login siswa
-   `/register` - Registrasi siswa
-   `/dashboard` - Dashboard siswa
-   `/profile` - Manajemen profil
-   `/pkl/daftar` - Lihat IDUKA tersedia
-   `/pkl/daftar/{iduka}` - Formulir pendaftaran PKL
-   `/pkl/history` - Riwayat pendaftaran

### Rute Admin (prefix: /admin)

-   `/admin/login` - Login petugas
-   `/admin/dashboard` - Dashboard admin
-   `/admin/siswa` - Kelola siswa (CRUD)
-   `/admin/iduka` - Kelola IDUKA (CRUD)
-   `/admin/pendaftaran` - Kelola pendaftaran (lihat, setujui, tolak)
-   `/admin/petugas` - Kelola petugas (CRUD, superadmin saja)

## Pengujian

Jalankan pengujian dengan PHPUnit:

```
./vendor/bin/phpunit
```

## Kontribusi

1. Fork repositori
2. Buat branch fitur
3. Buat perubahan dan tambahkan pengujian
4. Kirim pull request

## Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT.
