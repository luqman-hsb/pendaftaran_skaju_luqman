@extends('layouts.admin')

@section('title', 'Tambah IDUKA - Sistem Akademik')

@section('content')
<div class="p-6">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.iduka.index') }}" class="text-blue-500 hover:text-blue-600 mr-4">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Tambah IDUKA Baru</h1>
    </div>

    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 max-w-4xl">
        <form action="{{ route('admin.iduka.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama IDUKA -->
                <div class="md:col-span-2">
                    <label for="nama_iduka" class="block text-sm font-medium text-gray-700 mb-2">Nama IDUKA *</label>
                    <input type="text" id="nama_iduka" name="nama_iduka" value="{{ old('nama_iduka') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="Nama perusahaan/instansi" required>
                    @error('nama_iduka')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bidang Usaha -->
                <div class="md:col-span-2">
                    <label for="bidang_usaha" class="block text-sm font-medium text-gray-700 mb-2">Bidang Usaha *</label>
                    <input type="text" id="bidang_usaha" name="bidang_usaha" value="{{ old('bidang_usaha') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="Contoh: Teknologi Informasi, Perdagangan, Jasa" required>
                    @error('bidang_usaha')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kuota -->
                <div>
                    <label for="kuota" class="block text-sm font-medium text-gray-700 mb-2">Kuota Siswa *</label>
                    <input type="number" id="kuota" name="kuota" value="{{ old('kuota', 0) }}" min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           required>
                    @error('kuota')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kontak Person -->
                <div>
                    <label for="kontak_person" class="block text-sm font-medium text-gray-700 mb-2">Kontak Person</label>
                    <input type="text" id="kontak_person" name="kontak_person" value="{{ old('kontak_person') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="Nama penanggung jawab">
                </div>

                <!-- No Telepon -->
                <div>
                    <label for="no_telp" class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                    <input type="text" id="no_telp" name="no_telp" value="{{ old('no_telp') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="08xxxxxxxxxx">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="email@perusahaan.com">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat *</label>
                    <textarea id="alamat" name="alamat" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 resize-none"
                              placeholder="Alamat lengkap IDUKA" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('admin.iduka.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200">
                    Batal
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition duration-200">
                    Simpan IDUKA
                </button>
            </div>
        </form>
    </div>
</div>
@endsection