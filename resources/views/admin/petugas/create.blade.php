@extends('layouts.admin')

@section('title', 'Tambah Petugas - Sistem Akademik')

@section('content')
<div class="p-6">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.petugas.index') }}" class="text-blue-500 hover:text-blue-600 mr-4">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Petugas Baru</h1>
    </div>

    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 max-w-4xl">
        <form action="{{ route('admin.petugas.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Lengkap -->
                <div class="md:col-span-2">
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="Nama lengkap petugas" required>
                    @error('nama_lengkap')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jabatan -->
                <div>
                    <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="Contoh: Koordinator PKL">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="email@sekolah.sch.id" required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                    <input type="password" id="password" name="password" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="Minimal 6 karakter" required>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label for="is_superadmin" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="radio" name="is_superadmin" value="0" class="mr-2 text-blue-500" 
                                   {{ old('is_superadmin', 0) == 0 ? 'checked' : '' }}>
                            <span class="text-sm text-gray-700">Petugas Biasa</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="is_superadmin" value="1" class="mr-2 text-blue-500"
                                   {{ old('is_superadmin') == 1 ? 'checked' : '' }}>
                            <span class="text-sm text-gray-700">Super Admin</span>
                        </label>
                    </div>
                    @error('is_superadmin')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('admin.petugas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200">
                    Batal
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition duration-200">
                    Simpan Petugas
                </button>
            </div>
        </form>
    </div>
</div>
@endsection