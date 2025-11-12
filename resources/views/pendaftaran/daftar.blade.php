<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar IDUKA - Luqman's PKL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 50%, #10b981 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen" x-data="pklPage()">
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
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 transition duration-200">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <span class="text-gray-700">Halo, {{ Auth::user()->nama_lengkap ?? 'Siswa' }}</span>
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
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 fade-in">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    <span class="text-green-800">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4 fade-in">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                    <span class="text-red-800">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @if(session('info'))
            <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4 fade-in">
                <div class="flex items-center">
                    <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                    <span class="text-blue-800">{{ session('info') }}</span>
                </div>
            </div>
        @endif

        <div class="px-4 py-6 sm:px-0">
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 mb-2">Daftar Mitra Industri (IDUKA)</h1>
                        <p class="text-gray-600">Temukan dan pilih mitra industri yang sesuai dengan minat dan kompetensi Anda</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                            <span>{{ $idukaList->count() }} IDUKA tersedia</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <form method="GET" action="{{ route('pkl.daftar') }}" class="space-y-4 md:space-y-0 md:flex md:space-x-4 md:items-end">
                    <!-- Search Input -->
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari IDUKA</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input 
                                type="text" 
                                name="search" 
                                id="search"
                                value="{{ request('search') }}"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                placeholder="Cari berdasarkan nama, alamat, atau bidang usaha..."
                            >
                        </div>
                    </div>

                    <!-- Bidang Usaha Filter -->
                    <div class="flex-1">
                        <label for="bidang_usaha" class="block text-sm font-medium text-gray-700 mb-1">Bidang Usaha</label>
                        <select 
                            name="bidang_usaha" 
                            id="bidang_usaha"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        >
                            <option value="">Semua Bidang</option>
                            @foreach($bidangUsahaOptions as $bidang)
                                <option value="{{ $bidang }}" {{ request('bidang_usaha') == $bidang ? 'selected' : '' }}>
                                    {{ $bidang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-3">
                        <button 
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200 flex items-center"
                        >
                            <i class="fas fa-filter mr-2"></i> Terapkan
                        </button>
                        <a 
                            href="{{ route('pkl.daftar') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium transition duration-200 flex items-center"
                        >
                            <i class="fas fa-refresh mr-2"></i> Reset
                        </a>
                    </div>
                </form>

                <!-- Active Filters -->
                @if(request('search') || request('bidang_usaha'))
                    <div class="mt-4 flex flex-wrap gap-2">
                        @if(request('search'))
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                                Pencarian: "{{ request('search') }}"
                                <a href="{{ route('pkl.daftar', array_merge(request()->except('search'), ['search' => ''])) }}" class="ml-2 text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif
                        @if(request('bidang_usaha'))
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-100 text-green-800">
                                Bidang: {{ request('bidang_usaha') }}
                                <a href="{{ route('pkl.daftar', array_merge(request()->except('bidang_usaha'), ['bidang_usaha' => ''])) }}" class="ml-2 text-green-600 hover:text-green-800">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif
                    </div>
                @endif
            </div>

            <!-- IDUKA List -->
            <div x-show="!loading" class="fade-in">
                @if($idukaList->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($idukaList as $iduka)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden card-hover">
                                <!-- Header with gradient -->
                                <div class="bg-blue-600 px-6 py-4 text-white">
                                    <div class="flex justify-between items-start">
                                        <h3 class="font-bold text-lg truncate">{{ $iduka->nama_iduka }}</h3>
                                        <span class="bg-white bg-opacity-20 px-2 py-1 rounded-full text-xs font-medium">
                                            {{ $iduka->kuota }} kuota
                                        </span>
                                    </div>
                                    <p class="text-blue-100 text-sm mt-1 truncate">{{ $iduka->bidang_usaha }}</p>
                                </div>

                                <!-- Content -->
                                <div class="p-6">
                                    <!-- Info Items -->
                                    <div class="space-y-3 mb-4">
                                        <div class="flex items-start">
                                            <i class="fas fa-map-marker-alt text-gray-400 mt-1 mr-3 text-sm"></i>
                                            <span class="text-gray-600 text-sm flex-1">{{ $iduka->alamat }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-phone text-gray-400 mr-3 text-sm"></i>
                                            <span class="text-gray-600 text-sm">{{ $iduka->no_telp }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-envelope text-gray-400 mr-3 text-sm"></i>
                                            <span class="text-gray-600 text-sm truncate">{{ $iduka->email }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-user text-gray-400 mr-3 text-sm"></i>
                                            <span class="text-gray-600 text-sm">{{ $iduka->kontak_person }}</span>
                                        </div>
                                    </div>

                                    <!-- Status & Action -->
                                    <div class="border-t pt-4">
                                        @if($iduka->kuota > 0)
                                            <div class="flex justify-between items-center">
                                                <span class="text-green-600 text-sm font-medium">
                                                    <i class="fas fa-check-circle mr-1"></i> Masih tersedia
                                                </span>
                                                <a 
                                                    href="{{ route('pkl.form', $iduka->id) }}" 
                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200 flex items-center"
                                                >
                                                    <i class="fas fa-file-alt mr-2"></i> Daftar
                                                </a>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                <span class="text-red-600 text-sm font-medium">
                                                    <i class="fas fa-times-circle mr-1"></i> Kuota penuh
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                        <div class="max-w-md mx-auto">
                            <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-building text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada IDUKA ditemukan</h3>
                            <p class="text-gray-500 mb-6">
                                @if(request('search') || request('bidang_usaha'))
                                    Coba ubah kriteria pencarian atau filter Anda.
                                @else
                                    Saat ini tidak ada mitra industri yang tersedia untuk pendaftaran.
                                @endif
                            </p>
                            @if(request('search') || request('bidang_usaha'))
                                <a 
                                    href="{{ route('pkl.daftar') }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200 inline-flex items-center"
                                >
                                    <i class="fas fa-refresh mr-2"></i> Tampilkan Semua
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Loading State -->
            <div x-show="loading" class="text-center py-12">
                <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm rounded-lg text-blue-600">
                    <i class="fas fa-spinner fa-spin mr-2"></i>
                    Memuat data...
                </div>
            </div>
        </div>
    </div>

    <script>
        function pklPage() {
            return {
                loading: false,
                init() {
                    // Handle loading state during navigation
                    const links = document.querySelectorAll('a');
                    links.forEach(link => {
                        link.addEventListener('click', () => {
                            if (link.getAttribute('href') && !link.getAttribute('href').startsWith('#')) {
                                this.loading = true;
                            }
                        });
                    });
                }
            }
        }
    </script>
</body>
</html>