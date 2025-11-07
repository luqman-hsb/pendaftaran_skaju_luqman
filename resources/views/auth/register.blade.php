@extends('layouts.app')

@section('title', 'Daftar Siswa')

@section('content')
<div x-data="registerForm()" class="min-h-screen flex items-center justify-center p-4">
    <!-- Floating Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="floating absolute top-1/4 left-1/4 w-20 h-20 bg-white rounded-full opacity-10"></div>
        <div class="floating absolute top-1/3 right-1/4 w-16 h-16 bg-white rounded-full opacity-10" style="animation-delay: 1s;"></div>
        <div class="floating absolute bottom-1/4 left-1/3 w-24 h-24 bg-white rounded-full opacity-10" style="animation-delay: 2s;"></div>
    </div>

    <div class="max-w-2xl w-full space-y-8 slide-in">
        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto w-20 h-20 bg-white rounded-full flex items-center justify-center mb-4 pulse-glow">
                <i class="fas fa-user-plus text-2xl text-purple-600"></i>
            </div>
            <h2 class="text-3xl font-bold text-white">Daftar Akun Siswa</h2>
            <p class="mt-2 text-purple-100">Isi data diri Anda dengan benar</p>
        </div>

        <!-- Register Form -->
        <div class="card-glass rounded-2xl shadow-xl p-8">
            <form class="space-y-6" action="{{ route('register.submit') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- NIS -->
                    <div>
                        <label for="nis" class="block text-sm font-medium text-white">NIS *</label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-id-card text-purple-300"></i>
                            </div>
                            <input 
                                id="nis" 
                                name="nis" 
                                type="text" 
                                required 
                                class="block w-full pl-10 pr-3 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition duration-200"
                                placeholder="Nomor Induk Siswa"
                                value="{{ old('nis') }}"
                            >
                        </div>
                        @error('nis')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIK -->
                    <div>
                        <label for="nik" class="block text-sm font-medium text-white">NIK *</label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-address-card text-purple-300"></i>
                            </div>
                            <input 
                                id="nik" 
                                name="nik" 
                                type="text" 
                                required 
                                class="block w-full pl-10 pr-3 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition duration-200"
                                placeholder="Nomor Induk Kependudukan"
                                value="{{ old('nik') }}"
                            >
                        </div>
                        @error('nik')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="md:col-span-2">
                        <label for="nama_lengkap" class="block text-sm font-medium text-white">Nama Lengkap *</label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-purple-300"></i>
                            </div>
                            <input 
                                id="nama_lengkap" 
                                name="nama_lengkap" 
                                type="text" 
                                required 
                                class="block w-full pl-10 pr-3 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition duration-200"
                                placeholder="Nama lengkap siswa"
                                value="{{ old('nama_lengkap') }}"
                            >
                        </div>
                        @error('nama_lengkap')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kelas & Jurusan -->
                    <div>
                        <label for="kelas" class="block text-sm font-medium text-white">Kelas</label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-school text-purple-300"></i>
                            </div>
                            <input 
                                id="kelas" 
                                name="kelas" 
                                type="text" 
                                class="block w-full pl-10 pr-3 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition duration-200"
                                placeholder="Kelas"
                                value="{{ old('kelas') }}"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="jurusan" class="block text-sm font-medium text-white">Jurusan</label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-book text-purple-300"></i>
                            </div>
                            <input 
                                id="jurusan" 
                                name="jurusan" 
                                type="text" 
                                class="block w-full pl-10 pr-3 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition duration-200"
                                placeholder="Jurusan"
                                value="{{ old('jurusan') }}"
                            >
                        </div>
                    </div>

                    <!-- Email & No HP -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-white">Email</label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-purple-300"></i>
                            </div>
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                class="block w-full pl-10 pr-3 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition duration-200"
                                placeholder="Email aktif"
                                value="{{ old('email') }}"
                            >
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-white">No. HP</label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-purple-300"></i>
                            </div>
                            <input 
                                id="no_hp" 
                                name="no_hp" 
                                type="text" 
                                class="block w-full pl-10 pr-3 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition duration-200"
                                placeholder="Nomor handphone"
                                value="{{ old('no_hp') }}"
                            >
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-white">Alamat</label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
                                <i class="fas fa-home text-purple-300"></i>
                            </div>
                            <textarea 
                                id="alamat" 
                                name="alamat" 
                                rows="3"
                                class="block w-full pl-10 pr-3 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition duration-200"
                                placeholder="Alamat lengkap"
                            >{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-white">Password *</label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-purple-300"></i>
                            </div>
                            <input 
                                id="password" 
                                name="password" 
                                :type="showPassword ? 'text' : 'password'" 
                                required 
                                class="block w-full pl-10 pr-10 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition duration-200"
                                placeholder="Minimal 6 karakter"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" @click="showPassword = !showPassword" class="text-purple-300 hover:text-white transition duration-200">
                                    <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                </button>
                            </div>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-white">Konfirmasi Password *</label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-purple-300"></i>
                            </div>
                            <input 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                :type="showPassword ? 'text' : 'password'" 
                                required 
                                class="block w-full pl-10 pr-3 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent transition duration-200"
                                placeholder="Ulangi password"
                            >
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-green-500 to-blue-600 hover:from-green-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transform hover:scale-105 transition duration-200"
                    >
                        <i class="fas fa-user-plus mr-2"></i>
                        Daftar Sekarang
                    </button>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-purple-100">
                        Sudah punya akun?
                        <a href="{{ route('login.form') }}" class="font-medium text-white hover:text-purple-200 transition duration-200">
                            Masuk di sini
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center">
            <p class="text-purple-100 text-sm">
                &copy; 2024 Sistem Siswa. All rights reserved.
            </p>
        </div>
    </div>
</div>

<script>
    function registerForm() {
        return {
            showPassword: false,
            init() {
                // Add interactive animations
                const inputs = document.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    input.addEventListener('focus', () => {
                        input.parentElement.classList.add('ring-2', 'ring-white');
                    });
                    input.addEventListener('blur', () => {
                        input.parentElement.classList.remove('ring-2', 'ring-white');
                    });
                });
            }
        }
    }
</script>
@endsection