<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran PKL SKAJU - Sistem Pendaftaran Praktik Kerja Lapangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #1d4ed8;
            --secondary: #10b981;
            --accent: #8b5cf6;
            --light: #f8fafc;
            --dark: #1e293b;
            --gray: #64748b;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 50%, #10b981 100%);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 50%, #10b981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .slide-in-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        
        .slide-in-left.visible {
            opacity: 1;
            transform: translateX(0);
        }
        
        .slide-in-right {
            opacity: 0;
            transform: translateX(50px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        
        .slide-in-right.visible {
            opacity: 1;
            transform: translateX(0);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translate(0, 0px); }
            50% { transform: translate(0, -15px); }
            100% { transform: translate(0, 0px); }
        }
        
        .pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        .typewriter {
            overflow: hidden;
            border-right: .15em solid var(--primary);
            white-space: nowrap;
            margin: 0 auto;
            animation: typing 3.5s steps(40, end), blink-caret .75s step-end infinite;
        }
        
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }
        
        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: var(--primary); }
        }
        
        .scroll-hidden {
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800" x-data="homepage()">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md shadow-sm transition-all duration-300" 
         :class="{'py-2': scrolled, 'py-4': !scrolled}"
         x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 rounded-lg gradient-bg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold gradient-text">PKL SKAJU</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-300">Beranda</a>
                    <a href="#tentang" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-300">Tentang</a>
                    <a href="#fitur" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-300">Fitur</a>
                    <a href="#cara-kerja" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-300">Cara Kerja</a>
                    <a href="#daftar" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-300">Daftar</a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="/login" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-300 hidden md:block">Masuk</a>
                    <a href="/register" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-300 transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                        Daftar Sekarang
                    </a>
                    
                    <!-- Mobile menu button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-600 hover:text-blue-600 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile menu -->
            <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300" 
                 x-transition:enter-start="opacity-0 transform -translate-y-4" 
                 x-transition:enter-end="opacity-100 transform translate-y-0" 
                 x-transition:leave="transition ease-in duration-200" 
                 x-transition:leave-start="opacity-100 transform translate-y-0" 
                 x-transition:leave-end="opacity-0 transform -translate-y-4" 
                 class="md:hidden py-4 border-t border-gray-200 mt-4" x-cloak>
                <div class="flex flex-col space-y-4">
                    <a href="#beranda" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-300" @click="mobileMenuOpen = false">Beranda</a>
                    <a href="#tentang" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-300" @click="mobileMenuOpen = false">Tentang</a>
                    <a href="#fitur" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-300" @click="mobileMenuOpen = false">Fitur</a>
                    <a href="#cara-kerja" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-300" @click="mobileMenuOpen = false">Cara Kerja</a>
                    <a href="#daftar" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-300" @click="mobileMenuOpen = false">Daftar</a>
                    <a href="/login" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-300" @click="mobileMenuOpen = false">Masuk</a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section id="beranda" class="pt-28 pb-20 md:pt-36 md:pb-28 relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute top-0 left-0 w-full h-full z-0">
            <div class="absolute top-10 left-10 w-20 h-20 rounded-full bg-blue-100 opacity-50 floating"></div>
            <div class="absolute top-40 right-20 w-16 h-16 rounded-full bg-green-100 opacity-50 floating" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-20 left-1/4 w-24 h-24 rounded-full bg-purple-100 opacity-50 floating" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-40 right-1/4 w-12 h-12 rounded-full bg-blue-100 opacity-50 floating" style="animation-delay: 1.5s;"></div>
        </div>
        
        <div class="container mx-auto px-4 md:px-6 relative z-10">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0 fade-in" x-intersect:enter="addVisibleClass($el)">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                        Sistem Pendaftaran 
                        <span class="gradient-text">PKL SKAJU</span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600 mb-8 max-w-lg">
                        Platform digital modern untuk memudahkan proses pendaftaran Praktik Kerja Lapangan siswa SMK SKAJU. Daftar, pilih mitra industri, dan kelola PKL dengan mudah.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="/register" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium text-center transition-all duration-300 transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                            Daftar Sekarang
                        </a>
                        <a href="#tentang" class="border border-blue-600 text-blue-600 hover:bg-blue-50 px-6 py-3 rounded-lg font-medium text-center transition-all duration-300">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                
                <div class="md:w-1/2 flex justify-center slide-in-right" x-intersect:enter="addVisibleClass($el)">
                    <div class="relative">
                        <div class="w-80 h-80 md:w-96 md:h-96 rounded-full gradient-bg flex items-center justify-center floating">
                            <div class="bg-white w-64 h-64 md:w-80 md:h-80 rounded-full flex items-center justify-center shadow-xl">
                                <div class="text-center p-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">PKL Digital</h3>
                                    <p class="text-gray-600">Kelola pendaftaran PKL dengan mudah dan efisien</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating elements around the main circle -->
                        <div class="absolute -top-4 -left-4 bg-white p-4 rounded-xl shadow-lg card-hover">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700">Pendaftaran Mudah</span>
                            </div>
                        </div>
                        
                        <div class="absolute -bottom-4 -right-4 bg-white p-4 rounded-xl shadow-lg card-hover">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700">Proses Cepat</span>
                            </div>
                        </div>
                        
                        <div class="absolute top-1/2 -left-12 bg-white p-4 rounded-xl shadow-lg card-hover">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-700">Mitra Terpercaya</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- About Section -->
    <section id="tentang" class="py-20 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-16 fade-in" x-intersect:enter="addVisibleClass($el)">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Tentang Sistem PKL SKAJU</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Platform digital yang dirancang khusus untuk mempermudah proses pendaftaran dan pengelolaan Praktik Kerja Lapangan bagi siswa SMK SKAJU.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="fade-in" x-intersect:enter="addVisibleClass($el)">
                    <div class="bg-gradient-to-br from-blue-50 to-green-50 rounded-2xl p-8 shadow-lg">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Mengapa Memilih Sistem Kami?</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center mt-1 mr-3 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="text-gray-700">Proses pendaftaran yang sederhana dan mudah dipahami oleh siswa</p>
                            </li>
                            <li class="flex items-start">
                                <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center mt-1 mr-3 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="text-gray-700">Akses ke berbagai mitra industri terpercaya dan berkualitas</p>
                            </li>
                            <li class="flex items-start">
                                <div class="w-6 h-6 rounded-full bg-purple-100 flex items-center justify-center mt-1 mr-3 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="text-gray-700">Pantau status pendaftaran secara real-time kapan saja dan di mana saja</p>
                            </li>
                            <li class="flex items-start">
                                <div class="w-6 h-6 rounded-full bg-yellow-100 flex items-center justify-center mt-1 mr-3 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="text-gray-700">Dukungan penuh dari administrator sekolah untuk kelancaran proses</p>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="slide-in-right" x-intersect:enter="addVisibleClass($el)">
                    <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Visi & Misi</h3>
                        
                        <div class="mb-8">
                            <h4 class="text-lg font-semibold text-blue-600 mb-2">Visi</h4>
                            <p class="text-gray-700">
                                Menjadi platform digital terdepan dalam memfasilitasi hubungan yang efektif antara siswa SMK dengan dunia industri melalui sistem pendaftaran PKL yang modern dan efisien.
                            </p>
                        </div>
                        
                        <div>
                            <h4 class="text-lg font-semibold text-green-600 mb-2">Misi</h4>
                            <ul class="space-y-2 text-gray-700">
                                <li class="flex items-start">
                                    <span class="text-blue-500 mr-2">•</span>
                                    <span>Menyederhanakan proses pendaftaran PKL bagi siswa</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-green-500 mr-2">•</span>
                                    <span>Memperluas jaringan mitra industri yang berkualitas</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-purple-500 mr-2">•</span>
                                    <span>Meningkatkan transparansi dalam proses seleksi dan penempatan</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-yellow-500 mr-2">•</span>
                                    <span>Mendukung pengembangan kompetensi siswa sesuai kebutuhan industri</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Features Section -->
    <section id="fitur" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-16 fade-in" x-intersect:enter="addVisibleClass($el)">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Nikmati berbagai fitur canggih yang dirancang untuk mempermudah pengalaman pendaftaran PKL Anda.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg card-hover fade-in" x-intersect:enter="addVisibleClass($el)">
                    <div class="w-12 h-12 rounded-lg gradient-bg flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Pendaftaran Siswa</h3>
                    <p class="text-gray-600 mb-4">
                        Buat akun dengan mudah, lengkapi profil, dan akses berbagai mitra industri yang tersedia untuk memulai pendaftaran PKL.
                    </p>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Registrasi akun mudah</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Kelola profil pribadi</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Akses mitra industri terpercaya</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg card-hover fade-in" x-intersect:enter="addVisibleClass($el)" x-intersect:enter.delay="100">
                    <div class="w-12 h-12 rounded-lg gradient-bg flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Dashboard Admin</h3>
                    <p class="text-gray-600 mb-4">
                        Administrator dapat mengelola data siswa, mitra industri, dan meninjau pendaftaran PKL dengan antarmuka yang intuitif.
                    </p>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Kelola data siswa & IDUKA</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Tinjau & verifikasi pendaftaran</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Pantau kuota & penempatan</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg card-hover fade-in" x-intersect:enter="addVisibleClass($el)" x-intersect:enter.delay="200">
                    <div class="w-12 h-12 rounded-lg gradient-bg flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Akses Berbasis Peran</h3>
                    <p class="text-gray-600 mb-4">
                        Sistem dengan otentikasi terpisah untuk siswa dan petugas, memastikan keamanan dan akses yang tepat bagi setiap pengguna.
                    </p>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Login terpisah siswa & petugas</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Hak akses sesuai peran</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Keamanan data terjamin</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Feature 4 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg card-hover fade-in" x-intersect:enter="addVisibleClass($el)" x-intersect:enter.delay="300">
                    <div class="w-12 h-12 rounded-lg gradient-bg flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Manajemen Profil</h3>
                    <p class="text-gray-600 mb-4">
                        Siswa dapat dengan mudah memperbarui informasi pribadi, memastikan data selalu akurat untuk proses pendaftaran.
                    </p>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Update data pribadi</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Ubah informasi kontak</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Kelola preferensi notifikasi</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Feature 5 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg card-hover fade-in" x-intersect:enter="addVisibleClass($el)" x-intersect:enter.delay="400">
                    <div class="w-12 h-12 rounded-lg gradient-bg flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Riwayat Pendaftaran</h3>
                    <p class="text-gray-600 mb-4">
                        Akses riwayat lengkap semua pendaftaran PKL yang pernah diajukan, termasuk status dan catatan dari administrator.
                    </p>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Lihat riwayat pendaftaran</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Pantau status real-time</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Terima notifikasi update</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Feature 6 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg card-hover fade-in" x-intersect:enter="addVisibleClass($el)" x-intersect:enter.delay="500">
                    <div class="w-12 h-12 rounded-lg gradient-bg flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Teknologi Modern</h3>
                    <p class="text-gray-600 mb-4">
                        Dibangun dengan framework Laravel 10 dan teknologi terkini untuk performa optimal dan pengalaman pengguna terbaik.
                    </p>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Laravel 10 Framework</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Database MySQL</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Antarmuka responsif</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <!-- How It Works Section -->
    <section id="cara-kerja" class="py-20 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-16 fade-in" x-intersect:enter="addVisibleClass($el)">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Cara Kerja Sistem</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Hanya dengan 4 langkah sederhana, Anda dapat menyelesaikan pendaftaran PKL dan memulai pengalaman praktik kerja Anda.
                </p>
            </div>
            
            <div class="relative">
                <!-- Timeline line -->
                <div class="hidden md:block absolute top-1/2 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 to-green-500 transform -translate-y-1/2 z-0"></div>
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative z-10">
                    <!-- Step 1 -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg text-center card-hover fade-in" x-intersect:enter="addVisibleClass($el)">
                        <div class="w-16 h-16 rounded-full gradient-bg flex items-center justify-center mx-auto mb-4">
                            <span class="text-white font-bold text-xl">1</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Registrasi Akun</h3>
                        <p class="text-gray-600">
                            Buat akun siswa dengan mengisi formulir pendaftaran menggunakan NIS dan data pribadi Anda.
                        </p>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg text-center card-hover fade-in" x-intersect:enter="addVisibleClass($el)" x-intersect:enter.delay="100">
                        <div class="w-16 h-16 rounded-full gradient-bg flex items-center justify-center mx-auto mb-4">
                            <span class="text-white font-bold text-xl">2</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Lengkapi Profil</h3>
                        <p class="text-gray-600">
                            Lengkapi informasi profil Anda seperti kelas, jurusan, alamat, dan kontak untuk kelengkapan data.
                        </p>
                    </div>
                    
                    <!-- Step 3 -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg text-center card-hover fade-in" x-intersect:enter="addVisibleClass($el)" x-intersect:enter.delay="200">
                        <div class="w-16 h-16 rounded-full gradient-bg flex items-center justify-center mx-auto mb-4">
                            <span class="text-white font-bold text-xl">3</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Pilih Mitra IDUKA</h3>
                        <p class="text-gray-600">
                            Jelajahi daftar mitra industri yang tersedia dan pilih sesuai dengan minat dan kompetensi Anda.
                        </p>
                    </div>
                    
                    <!-- Step 4 -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg text-center card-hover fade-in" x-intersect:enter="addVisibleClass($el)" x-intersect:enter.delay="300">
                        <div class="w-16 h-16 rounded-full gradient-bg flex items-center justify-center mx-auto mb-4">
                            <span class="text-white font-bold text-xl">4</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Ajukan Pendaftaran</h3>
                        <p class="text-gray-600">
                            Ajukan formulir pendaftaran PKL dan tunggu konfirmasi dari administrator sekolah.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="mt-16 text-center fade-in" x-intersect:enter="addVisibleClass($el)">
                <a href="/register" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium text-lg transition-all duration-300 transform hover:-translate-y-1 shadow-md hover:shadow-lg inline-flex items-center">
                    <span>Mulai Sekarang</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
    
    <!-- Stats Section -->
    <section class="py-16 gradient-bg text-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="fade-in" x-intersect:enter="addVisibleClass($el)">
                    <div class="text-4xl md:text-5xl font-bold mb-2" x-data="{ count: 0, target: 500 }" x-init="() => { let interval = setInterval(() => { if (count < target) { count += 10; } else { clearInterval(interval); } }, 20); }" x-text="count">0</div>
                    <p class="text-blue-100">Siswa Terdaftar</p>
                </div>
                
                <div class="fade-in" x-intersect:enter="addVisibleClass($el)" x-intersect:enter.delay="100">
                    <div class="text-4xl md:text-5xl font-bold mb-2" x-data="{ count: 0, target: 50 }" x-init="() => { let interval = setInterval(() => { if (count < target) { count += 1; } else { clearInterval(interval); } }, 50); }" x-text="count">0</div>
                    <p class="text-blue-100">Mitra Industri</p>
                </div>
                
                <div class="fade-in" x-intersect:enter="addVisibleClass($el)" x-intersect:enter.delay="200">
                    <div class="text-4xl md:text-5xl font-bold mb-2" x-data="{ count: 0, target: 300 }" x-init="() => { let interval = setInterval(() => { if (count < target) { count += 6; } else { clearInterval(interval); } }, 20); }" x-text="count">0</div>
                    <p class="text-blue-100">Pendaftaran Disetujui</p>
                </div>
                
                <div class="fade-in" x-intersect:enter="addVisibleClass($el)" x-intersect:enter.delay="300">
                    <div class="text-4xl md:text-5xl font-bold mb-2" x-data="{ count: 0, target: 98 }" x-init="() => { let interval = setInterval(() => { if (count < target) { count += 1; } else { clearInterval(interval); } }, 30); }" x-text="count">0</div>
                    <p class="text-blue-100">Tingkat Kepuasan</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Registration CTA Section -->
    <section id="daftar" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-1/2 gradient-bg p-8 md:p-12 text-white">
                        <h2 class="text-3xl font-bold mb-4">Siap Memulai Pengalaman PKL Anda?</h2>
                        <p class="mb-6 text-blue-100">
                            Bergabunglah dengan ratusan siswa SMK SKAJU yang telah merasakan kemudahan pendaftaran PKL melalui sistem digital kami.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Proses pendaftaran yang mudah dan cepat</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Akses ke berbagai mitra industri terpercaya</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Pantau status pendaftaran secara real-time</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="md:w-1/2 p-8 md:p-12">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Daftar Sekarang</h3>
                        <p class="text-gray-600 mb-6">
                            Isi formulir berikut untuk membuat akun siswa dan memulai proses pendaftaran PKL.
                        </p>
                        
                        <form class="space-y-4">
                            <div>
                                <label for="nis" class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
                                <input type="text" id="nis" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300" placeholder="Masukkan NIS Anda">
                            </div>
                            
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" id="nama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300" placeholder="Masukkan nama lengkap">
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300" placeholder="Masukkan alamat email">
                            </div>
                            
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input type="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300" placeholder="Buat password">
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" id="agree" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="agree" class="ml-2 text-sm text-gray-600">
                                    Saya menyetujui <a href="#" class="text-blue-600 hover:underline">syarat dan ketentuan</a>
                                </label>
                            </div>
                            
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition-colors duration-300 transform hover:-translate-y-1 shadow-md hover:shadow-lg">
                                Daftar Sekarang
                            </button>
                            
                            <p class="text-center text-sm text-gray-600">
                                Sudah punya akun? <a href="/login" class="text-blue-600 font-medium hover:underline">Masuk di sini</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- FAQ Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-16 fade-in" x-intersect:enter="addVisibleClass($el)">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Pertanyaan Umum</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Temukan jawaban untuk pertanyaan yang sering diajukan tentang sistem pendaftaran PKL SKAJU.
                </p>
            </div>
            
            <div class="max-w-3xl mx-auto">
                <div class="space-y-6">
                    <!-- FAQ 1 -->
                    <div class="bg-gray-50 rounded-xl p-6 fade-in" x-intersect:enter="addVisibleClass($el)">
                        <button @click="faq1 = !faq1" class="flex justify-between items-center w-full text-left">
                            <h3 class="text-lg font-semibold text-gray-900">Siapa yang dapat mendaftar di sistem ini?</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 transition-transform duration-300" :class="{'rotate-180': faq1}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="faq1" x-transition:enter="transition ease-out duration-300" 
                             x-transition:enter-start="opacity-0 transform -translate-y-4" 
                             x-transition:enter-end="opacity-100 transform translate-y-0" 
                             x-transition:leave="transition ease-in duration-200" 
                             x-transition:leave-start="opacity-100 transform translate-y-0" 
                             x-transition:leave-end="opacity-0 transform -translate-y-4" 
                             class="mt-4 text-gray-600" x-cloak>
                            <p>Sistem pendaftaran PKL SKAJU ditujukan untuk semua siswa SMK SKAJU yang akan melaksanakan Praktik Kerja Lapangan. Siswa dapat mendaftar dengan menggunakan NIS yang valid.</p>
                        </div>
                    </div>
                    
                    <!-- FAQ 2 -->
                    <div class="bg-gray-50 rounded-xl p-6 fade-in" x-intersect:enter="addVisibleClass($el)" x-intersect:enter.delay="100">
                        <button @click="faq2 = !faq2" class="flex justify-between items-center w-full text-left">
                            <h3 class="text-lg font-semibold text-gray-900">Bagaimana cara memilih mitra industri (IDUKA)?</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 transition-transform duration-300" :class="{'rotate-180': faq2}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="faq2" x-transition:enter="transition ease-out duration-300" 
                             x-transition:enter-start="opacity-0 transform -translate-y-4" 
                             x-transition:enter-end="opacity-100 transform translate-y-0" 
                             x-transition:leave="transition ease-in duration-200" 
                             x-transition:leave-start="opacity-100 transform translate-y-0" 
                             x-transition:leave-end="opacity-0 transform -translate-y-4" 
                             class="mt-4 text-gray-600" x-cloak>
                            <p>Setelah login, Anda dapat mengakses menu "Daftar PKL" untuk melihat daftar mitra industri yang tersedia. Setiap IDUKA menampilkan informasi detail seperti alamat, bidang usaha, dan kuota penerimaan. Pilih IDUKA yang sesuai dengan minat dan kompetensi Anda.</p>
                        </div>
                    </div>
                    
                    <!-- FAQ 3 -->
                    <div class="bg-gray-50 rounded-xl p-6 fade-in" x-intersect:enter="addVisibleClass($el)" x-intersect:enter.delay="200">
                        <button @click="faq3 = !faq3" class="flex justify-between items-center w-full text-left">
                            <h3 class="text-lg font-semibold text-gray-900">Berapa lama proses persetujuan pendaftaran?</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 transition-transform duration-300" :class="{'rotate-180': faq3}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="faq3" x-transition:enter="transition ease-out duration-300" 
                             x-transition:enter-start="opacity-0 transform -translate-y-4" 
                             x-transition:enter-end="opacity-100 transform translate-y-0" 
                             x-transition:leave="transition ease-in duration-200" 
                             x-transition:leave-start="opacity-100 transform translate-y-0" 
                             x-transition:leave-end="opacity-0 transform -translate-y-4" 
                             class="mt-4 text-gray-600" x-cloak>
                            <p>Proses persetujuan biasanya memakan waktu 3-7 hari kerja setelah pendaftaran diajukan. Administrator akan meninjau aplikasi Anda dan melakukan koordinasi dengan mitra industri terkait. Anda dapat memantau status pendaftaran melalui dashboard siswa.</p>
                        </div>
                    </div>
                    
                    <!-- FAQ 4 -->
                    <div class="bg-gray-50 rounded-xl p-6 fade-in" x-intersect:enter="addVisibleClass($el)" x-intersect:enter.delay="300">
                        <button @click="faq4 = !faq4" class="flex justify-between items-center w-full text-left">
                            <h3 class="text-lg font-semibold text-gray-900">Apa yang harus dilakukan jika lupa password?</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 transition-transform duration-300" :class="{'rotate-180': faq4}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="faq4" x-transition:enter="transition ease-out duration-300" 
                             x-transition:enter-start="opacity-0 transform -translate-y-4" 
                             x-transition:enter-end="opacity-100 transform translate-y-0" 
                             x-transition:leave="transition ease-in duration-200" 
                             x-transition:leave-start="opacity-100 transform translate-y-0" 
                             x-transition:leave-end="opacity-0 transform -translate-y-4" 
                             class="mt-4 text-gray-600" x-cloak>
                            <p>Pada halaman login, klik tautan "Lupa Password" dan ikuti instruksi untuk mereset password Anda. Sistem akan mengirimkan link reset password ke email yang terdaftar. Pastikan Anda memiliki akses ke email tersebut.</p>
                        </div>
                    </div>
                    
                    <!-- FAQ 5 -->
                    <div class="bg-gray-50 rounded-xl p-6 fade-in" x-intersect:enter="addVisibleClass($el)" x-intersect:enter.delay="400">
                        <button @click="faq5 = !faq5" class="flex justify-between items-center w-full text-left">
                            <h3 class="text-lg font-semibold text-gray-900">Bisakah saya mengajukan pendaftaran ke lebih dari satu IDUKA?</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 transition-transform duration-300" :class="{'rotate-180': faq5}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="faq5" x-transition:enter="transition ease-out duration-300" 
                             x-transition:enter-start="opacity-0 transform -translate-y-4" 
                             x-transition:enter-end="opacity-100 transform translate-y-0" 
                             x-transition:leave="transition ease-in duration-200" 
                             x-transition:leave-start="opacity-100 transform translate-y-0" 
                             x-transition:leave-end="opacity-0 transform -translate-y-4" 
                             class="mt-4 text-gray-600" x-cloak>
                            <p>Ya, Anda dapat mengajukan pendaftaran ke beberapa IDUKA, namun hanya satu pendaftaran yang dapat aktif dalam satu waktu. Jika pendaftaran Anda diterima oleh satu IDUKA, pendaftaran lainnya akan secara otomatis dibatalkan.</p>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-12 fade-in" x-intersect:enter="addVisibleClass($el)">
                    <p class="text-gray-600 mb-4">Masih punya pertanyaan?</p>
                    <a href="mailto:pkl@sekolah.sch.id" class="inline-flex items-center text-blue-600 font-medium hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Hubungi Administrator
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4 md:px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 rounded-lg gradient-bg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold">PKL SKAJU</span>
                    </div>
                    <p class="text-gray-400 mb-4 max-w-md">
                        Sistem Pendaftaran Praktik Kerja Lapangan SMK SKAJU. Platform digital untuk memudahkan proses pendaftaran dan pengelolaan PKL siswa.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="#beranda" class="text-gray-400 hover:text-white transition-colors duration-300">Beranda</a></li>
                        <li><a href="#tentang" class="text-gray-400 hover:text-white transition-colors duration-300">Tentang</a></li>
                        <li><a href="#fitur" class="text-gray-400 hover:text-white transition-colors duration-300">Fitur</a></li>
                        <li><a href="#cara-kerja" class="text-gray-400 hover:text-white transition-colors duration-300">Cara Kerja</a></li>
                        <li><a href="/login" class="text-gray-400 hover:text-white transition-colors duration-300">Masuk</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Jl. Pendidikan No. 123, Kota Pendidikan</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>(021) 1234-5678</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>pkl@sekolah.sch.id</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2023 Pendaftaran PKL SKAJU. Seluruh hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>
    
    <script>
        function homepage() {
            return {
                // State
                scrolled: false,
                mobileMenuOpen: false,
                faq1: false,
                faq2: false,
                faq3: false,
                faq4: false,
                faq5: false,
                
                // Methods
                addVisibleClass(el) {
                    el.classList.add('visible');
                },
                
                init() {
                    // Initialize any components or data here
                    console.log('PKL SKAJU Homepage initialized');
                    
                    // Add scroll event listener for navbar
                    window.addEventListener('scroll', () => {
                        this.scrolled = window.scrollY > 10;
                    });
                }
            }
        }
        
        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Add intersection observer for fade-in animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);
            
            // Observe all elements with animation classes
            document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>
</html>