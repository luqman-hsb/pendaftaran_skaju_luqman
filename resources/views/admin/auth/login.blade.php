@extends('layouts.admin')

@section('title', 'Login Petugas - Sistem Akademik')

@section('content')
<div x-data="loginForm()" class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-10 left-10 w-8 h-8 bg-blue-200 rounded-full opacity-50"></div>
        <div class="absolute top-32 right-20 w-12 h-12 bg-indigo-200 rounded-full opacity-50"></div>
        <div class="absolute bottom-20 left-20 w-16 h-16 bg-purple-200 rounded-full opacity-50"></div>
    </div>

    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                <i class="fas fa-user-shield text-2xl text-white"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Login Petugas</h2>
            <p class="mt-3 text-gray-600">Sistem Administrasi Akademik</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white rounded-xl shadow-2xl p-8">
            <form class="space-y-6" action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                            <span class="text-red-800 text-sm">Email atau password salah</span>
                        </div>
                    </div>
                @endif

                <!-- Email Input -->
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
                            required 
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Masukkan email Anda"
                            value="{{ old('email') }}"
                        >
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input 
                            id="password" 
                            name="password" 
                            :type="showPassword ? 'text' : 'password'" 
                            required 
                            class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Masukkan password Anda"
                        >
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" @click="showPassword = !showPassword" class="text-gray-400 hover:text-gray-600 transition duration-200">
                                <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white py-3 px-4 rounded-lg shadow-lg transition duration-200 font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform hover:scale-105"
                    >
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Masuk sebagai Petugas
                    </button>
                </div>

                <!-- Back to Student Login -->
                <div class="text-center pt-4 border-t border-gray-100">
                    <p class="text-gray-600 text-sm">
                        Siswa?
                        <a href="{{ url('/login') }}" class="font-medium text-blue-600 hover:text-blue-500 transition duration-200">
                            Login di sini
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
    function loginForm() {
        return {
            showPassword: false,
            init() {
                // Add input focus effects
                const inputs = document.querySelectorAll('input');
                inputs.forEach(input => {
                    input.addEventListener('focus', function() {
                        this.parentElement.classList.add('ring-2', 'ring-blue-100');
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