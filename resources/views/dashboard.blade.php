<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-graduation-cap text-blue-600 text-2xl mr-3"></i>
                        <span class="text-xl font-semibold text-gray-800">Sistem Akademik</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Halo, {{ Auth::user()->nama_lengkap }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white rounded-lg shadow p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Dashboard Siswa</h1>
                <p class="text-gray-600 mb-6">Selamat datang di Sistem Informasi Akademik</p>
                
                <!-- Student Info Card -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                    <h2 class="text-lg font-semibold text-blue-800 mb-4">Informasi Profil</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-blue-600">NIS</p>
                            <p class="font-medium">{{ Auth::user()->nis }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-blue-600">Nama Lengkap</p>
                            <p class="font-medium">{{ Auth::user()->nama_lengkap }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-blue-600">Kelas</p>
                            <p class="font-medium">{{ Auth::user()->kelas ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-blue-600">Jurusan</p>
                            <p class="font-medium">{{ Auth::user()->jurusan ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                        <i class="fas fa-book text-blue-500 text-2xl mb-3"></i>
                        <h3 class="font-semibold text-gray-800">Mata Pelajaran</h3>
                        <p class="text-2xl font-bold text-blue-600 mt-2">12</p>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                        <i class="fas fa-chart-line text-green-500 text-2xl mb-3"></i>
                        <h3 class="font-semibold text-gray-800">Nilai Rata-rata</h3>
                        <p class="text-2xl font-bold text-green-600 mt-2">85.5</p>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                        <i class="fas fa-calendar text-purple-500 text-2xl mb-3"></i>
                        <h3 class="font-semibold text-gray-800">Kehadiran</h3>
                        <p class="text-2xl font-bold text-purple-600 mt-2">94%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>