<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Luqman's PKL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-graduation-cap text-blue-600 text-2xl mr-3"></i>
                        <span class="text-xl font-semibold text-gray-800">Luqman's PKL</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Halo, {{ $siswa->nama_lengkap }}</span>
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
        <!-- Notifications -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    <span class="text-green-800">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                    <span class="text-red-800">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @if(session('info'))
            <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                    <span class="text-blue-800">{{ session('info') }}</span>
                </div>
            </div>
        @endif

        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Dashboard Siswa</h1>
                <p class="text-gray-600 mb-6">Selamat datang di Sistem Informasi Akademik</p>
                
                <!-- Student Info Card -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                    <h2 class="text-lg font-semibold text-blue-800 mb-4">Informasi Profil</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <p class="text-sm text-blue-600">NIS</p>
                            <p class="font-medium">{{ $siswa->nis }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-blue-600">Nama Lengkap</p>
                            <p class="font-medium">{{ $siswa->nama_lengkap }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-blue-600">Kelas</p>
                            <p class="font-medium">{{ $siswa->kelas ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-blue-600">Jurusan</p>
                            <p class="font-medium">{{ $siswa->jurusan ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- PKL Status Card -->
                <div x-data="pklStatus()" class="mb-6">
                    @if($activePKL)
                        <!-- Sudah PKL -->
                        <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-lg font-semibold text-green-800 mb-2">
                                        <i class="fas fa-building mr-2"></i>Status PKL
                                    </h2>
                                    <p class="text-green-700 mb-1">
                                        <strong>IDUKA:</strong> {{ $activePKL->iduka->nama_iduka }}
                                    </p>
                                    <p class="text-green-700 mb-1">
                                        <strong>Bidang Usaha:</strong> {{ $activePKL->iduka->bidang_usaha }}
                                    </p>
                                    <p class="text-green-700 mb-1">
                                        <strong>Alamat:</strong> {{ $activePKL->iduka->alamat }}
                                    </p>
                                    <p class="text-green-700 mb-3">
                                        <strong>Mulai Berlaku:</strong> {{ $activePKL->tanggal_berlaku->format('d F Y') }}
                                    </p>
                                    
                                    <!-- Countdown Timer -->
                                    <div class="mt-4">
                                        <p class="text-sm text-green-600 mb-2">Sisa Waktu PKL:</p>
                                        <div class="flex space-x-4">
                                            <div class="text-center">
                                                <div class="bg-white rounded-lg p-2 shadow">
                                                    <span x-text="days" class="text-2xl font-bold text-green-600"></span>
                                                    <p class="text-xs text-green-500">Hari</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div class="bg-white rounded-lg p-2 shadow">
                                                    <span x-text="hours" class="text-2xl font-bold text-green-600"></span>
                                                    <p class="text-xs text-green-500">Jam</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div class="bg-white rounded-lg p-2 shadow">
                                                    <span x-text="minutes" class="text-2xl font-bold text-green-600"></span>
                                                    <p class="text-xs text-green-500">Menit</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div class="bg-white rounded-lg p-2 shadow">
                                                    <span x-text="seconds" class="text-2xl font-bold text-green-600"></span>
                                                    <p class="text-xs text-green-500">Detik</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                        Aktif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @elseif($pendingRegistration)
                        <!-- Sedang Menunggu Persetujuan -->
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-lg font-semibold text-yellow-800 mb-2">
                                        <i class="fas fa-clock mr-2"></i>Status Pendaftaran PKL
                                    </h2>
                                    <p class="text-yellow-700">
                                        Pendaftaran PKL Anda sedang menunggu persetujuan dari petugas.
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                        Menunggu
                                    </span>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Belum PKL -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-lg font-semibold text-blue-800 mb-2">
                                        <i class="fas fa-briefcase mr-2"></i>Status PKL
                                    </h2>
                                    <p class="text-blue-700">
                                        Anda belum memiliki tempat PKL. Daftar sekarang untuk mengikuti Praktik Kerja Lapangan.
                                    </p>
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('pkl.daftar') }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition duration-200 font-medium">
                                        <i class="fas fa-plus mr-2"></i>Daftar PKL
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>


                <!-- Quick Actions -->
                <div class="mt-8 border-t pt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <a href="{{ route('pkl.daftar') }}" class="bg-white border border-gray-200 rounded-lg p-4 text-center hover:shadow-md transition duration-200">
                            <i class="fas fa-building text-blue-500 text-xl mb-2"></i>
                            <p class="font-medium text-gray-700">Daftar PKL</p>
                        </a>
                        <a href="{{ route('pkl.history') }}" class="bg-white border border-gray-200 rounded-lg p-4 text-center hover:shadow-md transition duration-200">
                            <i class="fas fa-history text-green-500 text-xl mb-2"></i>
                            <p class="font-medium text-gray-700">Riwayat PKL</p>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="bg-white border border-gray-200 rounded-lg p-4 text-center hover:shadow-md transition duration-200">
                            <i class="fas fa-user-edit text-orange-500 text-xl mb-2"></i>
                            <p class="font-medium text-gray-700">Edit Profil</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function pklStatus() {
            return {
                days: 0,
                hours: 0,
                minutes: 0,
                seconds: 0,
                init() {
                    @if($activePKL)
                        const endDate = new Date('{{ $activePKL->tanggal_berlaku->addMonths(6)->format('Y-m-d H:i:s') }}');
                        this.updateCountdown(endDate);
                        setInterval(() => {
                            this.updateCountdown(endDate);
                        }, 1000);
                    @endif
                },
                updateCountdown(endDate) {
                    const now = new Date().getTime();
                    const distance = endDate - now;

                    if (distance < 0) {
                        this.days = 0;
                        this.hours = 0;
                        this.minutes = 0;
                        this.seconds = 0;
                        return;
                    }

                    this.days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    this.hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    this.minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    this.seconds = Math.floor((distance % (1000 * 60)) / 1000);
                }
            }
        }
    </script>
</body>
</html>