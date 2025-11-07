@extends('layouts.app')

@section('title', 'Registrasi Siswa - Sistem Akademik')

@section('content')
<div x-data="registerForm()" class="min-h-screen flex items-center justify-center p-4 py-8">
    <!-- Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-20 w-6 h-6 bg-green-200 rounded-full opacity-50 floating-slow"></div>
        <div class="absolute top-40 right-32 w-8 h-8 bg-blue-200 rounded-full opacity-50 floating-slow" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-32 left-32 w-10 h-10 bg-teal-200 rounded-full opacity-50 floating-slow" style="animation-delay: 4s;"></div>
    </div>

    <div class="max-w-4xl w-full space-y-8 slide-up">
        <!-- Header -->
        <div class="text-center fade-in">
            <div class="mx-auto w-20 h-20 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center mb-6 shadow-lg">
                <i class="fas fa-user-plus text-2xl text-white"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Registrasi Siswa Baru</h2>
            <p class="mt-3 text-gray-600">Lengkapi data diri Anda untuk bergabung</p>
        </div>

        <!-- Register Form -->
        <div class="card-elegant rounded-xl p-8">
            <form class="space-y-6" action="{{ route('register.submit') }}" method="POST">
                @csrf
                
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                            <span class="text-red-800 text-sm">Terdapat kesalahan dalam pengisian form</span>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- NIS -->
                    <div>
                        <label for="nis" class="block text-sm font-medium text-gray-700 mb-2">NIS *</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-id-card text-gray-400"></i>
                            </div>
                            <input 
                                id="nis" 
                                name="nis" 
                                type="text" 
                                required 
                                class="input-focus block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none transition duration-200"
                                placeholder="Nomor Induk Siswa"
                                value="{{ old('nis') }}"
                            >
                        </div>
                        @error('nis')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIK -->
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">NIK *</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-address-card text-gray-400"></i>
                            </div>
                            <input 
                                id="nik" 
                                name="nik" 
                                type="text" 
                                required 
                                class="input-focus block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none transition duration-200"
                                placeholder="Nomor Induk Kependudukan"
                                value="{{ old('nik') }}"
                            >
                        </div>
                        @error('nik')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="md:col-span-2">
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input 
                                id="nama_lengkap" 
                                name="nama_lengkap" 
                                type="text" 
                                required 
                                class="input-focus block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none transition duration-200"
                                placeholder="Nama lengkap sesuai dokumen"
                                value="{{ old('nama_lengkap') }}"
                            >
                        </div>
                        @error('nama_lengkap')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kelas & Jurusan -->
                    <div>
                        <label for="kelas" class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-school text-gray-400"></i>
                            </div>
                            <input 
                                id="kelas" 
                                name="kelas" 
                                type="text" 
                                class="input-focus block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none transition duration-200"
                                placeholder="Contoh: X IPA 1"
                                value="{{ old('kelas') }}"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="jurusan" class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-book text-gray-400"></i>
                            </div>
                            <input 
                                id="jurusan" 
                                name="jurusan" 
                                type="text" 
                                class="input-focus block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none transition duration-200"
                                placeholder="Contoh: IPA, IPS, Bahasa"
                                value="{{ old('jurusan') }}"
                            >
                        </div>
                    </div>

                    <!-- Email & No HP -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                class="input-focus block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none transition duration-200"
                                placeholder="email@example.com"
                                value="{{ old('email') }}"
                            >
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <input 
                                id="no_hp" 
                                name="no_hp" 
                                type="text" 
                                class="input-focus block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none transition duration-200"
                                placeholder="08xxxxxxxxxx"
                                value="{{ old('no_hp') }}"
                            >
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                        <div class="relative">
                            <div class="absolute top-3 left-3 pointer-events-none">
                                <i class="fas fa-home text-gray-400"></i>
                            </div>
                            <textarea 
                                id="alamat" 
                                name="alamat" 
                                rows="3"
                                class="input-focus block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none transition duration-200 resize-none"
                                placeholder="Alamat lengkap tempat tinggal"
                            >{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input 
                                id="password" 
                                name="password" 
                                :type="showPassword ? 'text' : 'password'" 
                                required 
                                class="input-focus block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none transition duration-200"
                                placeholder="Minimal 6 karakter"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" @click="showPassword = !showPassword" class="text-gray-400 hover:text-gray-600 transition duration-200">
                                    <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                </button>
                            </div>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password *</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                :type="showPassword ? 'text' : 'password'" 
                                required 
                                class="input-focus block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none transition duration-200"
                                placeholder="Ketik ulang password"
                            >
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button 
                        type="submit" 
                        class="btn-secondary w-full flex justify-center py-3 px-4 border border-transparent rounded-lg text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                    >
                        <i class="fas fa-user-plus mr-2"></i>
                        Daftar Sekarang
                    </button>
                </div>

                <!-- Login Link -->
                <div class="text-center pt-4 border-t border-gray-100">
                    <p class="text-gray-600 text-sm">
                        Sudah memiliki akun?
                        <a href="{{ route('login.form') }}" class="font-medium text-green-600 hover:text-green-500 transition duration-200">
                            Masuk di sini
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center">
            <p class="text-gray-500 text-sm">
                &copy; 2024 Sistem Akademik. All rights reserved.
            </p>
        </div>
    </div>
</div>

<script>
    function registerForm() {
        return {
            showPassword: false,
            init() {
                // Add input interactions
                const inputs = document.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    input.addEventListener('focus', function() {
                        this.parentElement.classList.add('ring-2', 'ring-blue-100', 'rounded-lg');
                    });
                    input.addEventListener('blur', function() {
                        this.parentElement.classList.remove('ring-2', 'ring-blue-100');
                    });
                });
            }
        }
    }
</script>
@endsection