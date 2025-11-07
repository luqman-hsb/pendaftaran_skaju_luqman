@extends('layouts.admin')

@section('title', 'Edit Siswa - Sistem Akademik')

@section('content')
<div class="p-6">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.siswa.index') }}" class="text-blue-500 hover:text-blue-600 mr-4">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Edit Data Siswa</h1>
    </div>

    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 max-w-4xl">
        <form action="{{ route('admin.siswa.update', $siswa) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- NIS -->
                <div>
                    <label for="nis" class="block text-sm font-medium text-gray-700 mb-2">NIS *</label>
                    <input type="text" id="nis" name="nis" value="{{ old('nis', $siswa->nis) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="Nomor Induk Siswa" required>
                    @error('nis')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- NIK -->
                <div>
                    <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">NIK *</label>
                    <input type="text" id="nik" name="nik" value="{{ old('nik', $siswa->nik) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="Nomor Induk Kependudukan" required>
                    @error('nik')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Lengkap -->
                <div class="md:col-span-2">
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="Nama lengkap siswa" required>
                    @error('nama_lengkap')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kelas & Jurusan -->
                <div>
                    <label for="kelas" class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                    <input type="text" id="kelas" name="kelas" value="{{ old('kelas', $siswa->kelas) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="Contoh: X IPA 1">
                </div>

                <div>
                    <label for="jurusan" class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                    <input type="text" id="jurusan" name="jurusan" value="{{ old('jurusan', $siswa->jurusan) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="Contoh: IPA, IPS, Bahasa">
                </div>

                <!-- Email & No HP -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $siswa->email) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="email@example.com">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                    <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="08xxxxxxxxxx">
                </div>

                <!-- Password -->
                <div class="md:col-span-2">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="Kosongkan jika tidak ingin mengubah">
                    <p class="mt-1 text-sm text-gray-500">Minimal 6 karakter</p>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 resize-none"
                              placeholder="Alamat lengkap">{{ old('alamat', $siswa->alamat) }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('admin.siswa.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200">
                    Batal
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition duration-200">
                    Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection