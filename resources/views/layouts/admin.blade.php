<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Sistem Akademik')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .sidebar {
            transition: all 0.3s ease;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.mobile-open {
                transform: translateX(0);
            }
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Active state styles */
        .nav-item-active {
            background-color: rgb(29 78 216) !important;
            color: white !important;
        }
        
        .nav-item-inactive {
            color: rgb(191 219 254) !important;
        }
        
        .nav-item-inactive:hover {
            background-color: rgb(29 78 216) !important;
            color: white !important;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen">
        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="sidebar fixed inset-y-0 left-0 z-50 w-64 bg-blue-800 text-white transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-between p-4 border-b border-blue-700">
                <div class="flex items-center">
                    <i class="fas fa-graduation-cap text-2xl mr-3"></i>
                    <span class="text-xl font-semibold">Admin Panel</span>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <nav class="mt-8">
                <div class="px-4 space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'nav-item-active' : 'nav-item-inactive' }}">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>

                    <!-- Siswa -->
                    <a href="{{ route('admin.siswa.index') }}" 
                       class="flex items-center px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.siswa.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                        <i class="fas fa-users mr-3"></i>
                        Manajemen Siswa
                    </a>

                    <!-- IDUKA -->
                    <a href="{{ route('admin.iduka.index') }}" 
                       class="flex items-center px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.iduka.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                        <i class="fas fa-building mr-3"></i>
                        Manajemen IDUKA
                    </a>

                    <!-- Pendaftaran PKL -->
                    <a href="{{ route('admin.pendaftaran.index') }}" 
                       class="flex items-center px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.pendaftaran.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                        <i class="fas fa-clipboard-list mr-3"></i>
                        Pendaftaran PKL
                    </a>

                    <!-- Petugas (hanya superadmin) -->
                    @if(Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->is_superadmin)
                        <a href="{{ route('admin.petugas.index') }}"
                           class="flex items-center px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.petugas.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                            <i class="fas fa-user-shield mr-3"></i>
                            Manajemen Petugas
                        </a>
                    @endif
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true" class="lg:hidden mr-4 text-gray-600">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-2xl font-semibold text-gray-800">@yield('header-title', 'Admin Panel')</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if(Auth::guard('petugas')->check())
                            <div class="text-right">
                                <p class="font-medium text-gray-800">{{ Auth::guard('petugas')->user()->nama_lengkap }}</p>
                                <p class="text-sm text-gray-600">{{ Auth::guard('petugas')->user()->jabatan ?? 'Petugas' }}</p>
                            </div>
                            <div class="relative">
                                <button class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white">
                                    <i class="fas fa-user"></i>
                                </button>
                            </div>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Overlay for mobile sidebar -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" 
         class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
    </div>
</body>
</html>