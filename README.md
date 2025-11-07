# Pendaftaran PKL SKAJU

## Overview

Pendaftaran PKL SKAJU is a web-based application built with Laravel for managing student internship (Praktik Kerja Lapangan - PKL) registrations at SMK SKAJU. The system allows students to register for internships at industrial partners (IDUKA), while administrators and officers manage students, IDUKA, and registration approvals.

## Features

-   **Student Registration**: Students can create accounts, view available IDUKA, and submit PKL registration forms.
-   **Admin Dashboard**: Officers can manage students, IDUKA, and review/approve/reject PKL registrations.
-   **Role-Based Access**: Separate authentication for students and officers, with superadmin privileges for managing officers.
-   **Profile Management**: Students can update their profiles.
-   **Registration History**: Students can view their PKL registration history.

## Technology Stack

-   **Framework**: Laravel 10
-   **Database**: MySQL (or compatible with Laravel's database agnostic migrations)
-   **Frontend**: Blade templates with Bootstrap (via Vite for asset compilation)
-   **Authentication**: Laravel Sanctum for API, custom guards for students and officers
-   **Other**: Composer for dependency management, PHPUnit for testing

## Installation

1. Clone the repository:

    ```
    git clone <repository-url>
    cd pendaftaran-pkl-skaju
    ```

2. Install dependencies:

    ```
    composer install
    npm install
    ```

3. Set up environment:

    - Copy `.env.example` to `.env`
    - Configure database settings in `.env`
    - Generate application key: `php artisan key:generate`

4. Run migrations and seeders:

    ```
    php artisan migrate
    php artisan db:seed
    ```

5. Compile assets:

    ```
    npm run build
    ```

6. Start the development server:
    ```
    php artisan serve
    ```

## Database Structure

The application uses the following database tables:

### table_petugas (Officers)

-   `id` (primary key)
-   `nama_lengkap` (string)
-   `jabatan` (string, nullable)
-   `email` (string, unique)
-   `password` (string)
-   `is_superadmin` (boolean, default false)
-   `timestamps`

### table_siswa (Students)

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

### table_iduka (Industrial Partners)

-   `id` (primary key)
-   `nama_iduka` (string)
-   `alamat` (text)
-   `bidang_usaha` (string)
-   `kontak_person` (string, nullable)
-   `no_telp` (string, 50, nullable)
-   `email` (string, 100, nullable)
-   `kuota` (integer, default 0)
-   `timestamps`

### table_pendaftaran (Registrations)

-   `id` (primary key)
-   `siswa_id` (foreign key to table_siswa, cascade on delete)
-   `iduka_id` (foreign key to table_iduka, cascade on delete)
-   `petugas_id` (foreign key to table_petugas, nullable, null on delete)
-   `tanggal_daftar` (date)
-   `tanggal_berlaku` (date, nullable)
-   `status` (enum: 'menunggu', 'diterima', 'ditolak', default 'menunggu')
-   `catatan_penolakan` (text, nullable)
-   `timestamps`

## Dummy Data

The application includes seeders for initial data:

### Petugas Seeder

-   Administrator (Super Admin): email `admin@sekolah.sch.id`, password `password123`
-   Petugas PKL (Koordinator PKL): email `pkl@sekolah.sch.id`, password `password123`

To run seeders:

```
php artisan db:seed --class=PetugasSeeder
```

## Routes

### Student Routes

-   `/` - Login page
-   `/login` - Student login
-   `/register` - Student registration
-   `/dashboard` - Student dashboard
-   `/profile` - Profile management
-   `/pkl/daftar` - View available IDUKA
-   `/pkl/daftar/{iduka}` - PKL registration form
-   `/pkl/history` - Registration history

### Admin Routes (prefix: /admin)

-   `/admin/login` - Officer login
-   `/admin/dashboard` - Admin dashboard
-   `/admin/siswa` - Manage students (CRUD)
-   `/admin/iduka` - Manage IDUKA (CRUD)
-   `/admin/pendaftaran` - Manage registrations (view, approve, reject)
-   `/admin/petugas` - Manage officers (CRUD, superadmin only)

## Testing

Run tests with PHPUnit:

```
./vendor/bin/phpunit
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make changes and add tests
4. Submit a pull request

## License

This project is licensed under the MIT License.
