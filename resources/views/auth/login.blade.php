@extends('layouts.app')

@section('title', 'Login Siswa')

@section('content')
<div x-data="loginForm()" class="min-h-screen flex items-center justify-center p-4">
    <!-- Floating Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="floating absolute top-1/4 left-1/4 w-20 h-20 bg-white rounded-full opacity-10"></div>
        <div class="floating absolute top-1/3 right-1/4 w-16 h-16 bg-white rounded-full opacity-10" style="animation-delay: 1s;"></div>
        <div class="floating absolute bottom-1/4 left-1/3 w-24 h-24 bg-white rounded-full opacity-10" style="animation-delay: 2s;"></div>
    </div>

    <div class="max-w-md w-full space-y-8 slide-in">
        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto w-20 h-20 bg-white rounded-full flex items-center justify-center mb-4 pulse-glow">
                <i class="fas fa-graduation-cap text-2xl text-purple-600"></i>
            </div>
            <h2 class="text-3xl font-bold text-white">Selamat Datang</h2>
            <p class="mt-2 text-purple-100">Masuk ke akun siswa Anda</p>
        </div>

        <!-- Login Form -->
        <div class="card-glass rounded-2xl shadow-xl p-8">
            <form class="space-y-6" action="{{ route('login.submit') }}" method="POST">
                @csrf
                
                <!-- NIS Input -->
                <div>
                    <label for="nis" class="block text-sm font-medium text-white">NIS</label>
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
                            placeholder="Masukkan NIS Anda"
                            value="{{ old('nis') }}"
                        >
                    </div>
                    @error('nis')
                        <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-sm font-medium text-white">Password</label>
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
                            placeholder="Masukkan password"
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

                <!-- Submit Button -->
                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transform hover:scale-105 transition duration-200"
                    >
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Masuk
                    </button>
                </div>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-purple-100">
                        Belum punya akun?
                        <a href="{{ route('register.form') }}" class="font-medium text-white hover:text-purple-200 transition duration-200">
                            Daftar di sini
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
    function loginForm() {
        return {
            showPassword: false,
            init() {
                // Add some interactive animations
                const inputs = document.querySelectorAll('input');
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