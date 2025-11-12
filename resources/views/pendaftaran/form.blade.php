@extends('layouts.app')

@section('title', 'Form Pendaftaran PKL - Luqman\'s PKL')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-800">Form Pendaftaran PKL</h1>
            <p class="text-gray-600 mt-2">Ajukan pendaftaran ke {{ $iduka->nama_iduka }}</p>
        </div>

        <!-- IDUKA Info -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi IDUKA</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Nama IDUKA</p>
                    <p class="font-medium">{{ $iduka->nama_iduka }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Bidang Usaha</p>
                    <p class="font-medium">{{ $iduka->bidang_usaha }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-600">Alamat</p>
                    <p class="font-medium">{{ $iduka->alamat }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Kontak Person</p>
                    <p class="font-medium">{{ $iduka->kontak_person ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Kuota Tersedia</p>
                    <p class="font-medium">{{ $iduka->kuota }} siswa</p>
                </div>
            </div>
        </div>

        <!-- Registration Form -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <form action="{{ route('pkl.store', $iduka) }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <p class="text-gray-700 mb-4">
                        Anda akan mendaftar ke <strong>{{ $iduka->nama_iduka }}</strong> yang bergerak di bidang 
                        <strong>{{ $iduka->bidang_usaha }}</strong>. Pastikan Anda telah mempertimbangkan pilihan ini dengan baik.
                    </p>
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                        <div>
                            <p class="text-blue-800 text-sm">
                                Pendaftaran Anda akan ditinjau oleh petugas. Anda akan mendapatkan notifikasi ketika status pendaftaran berubah.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('pkl.daftar') }}" class="text-gray-600 hover:text-gray-800 font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition duration-200 font-medium">
                        <i class="fas fa-paper-plane mr-2"></i>Ajukan Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection