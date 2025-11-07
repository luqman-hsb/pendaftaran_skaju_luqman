@extends('layouts.app')

@section('title', 'Daftar PKL - Sistem Akademik')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Pendaftaran Praktik Kerja Lapangan</h1>
            <p class="text-gray-600 mt-2">Pilih IDUKA untuk mengajukan pendaftaran PKL</p>
        </div>

        <!-- IDUKA List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($idukaList as $iduka)
                <div class="bg-white rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition duration-200">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $iduka->nama_iduka }}</h3>
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                                Kuota: {{ $iduka->kuota }}
                            </span>
                        </div>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-industry mr-2 w-4"></i>
                                <span class="text-sm">{{ $iduka->bidang_usaha }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-map-marker-alt mr-2 w-4"></i>
                                <span class="text-sm">{{ Str::limit($iduka->alamat, 50) }}</span>
                            </div>
                            @if($iduka->kontak_person)
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-user mr-2 w-4"></i>
                                <span class="text-sm">{{ $iduka->kontak_person }}</span>
                            </div>
                            @endif
                            @if($iduka->no_telp)
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-phone mr-2 w-4"></i>
                                <span class="text-sm">{{ $iduka->no_telp }}</span>
                            </div>
                            @endif
                        </div>

                        <a href="{{ route('pkl.form', $iduka) }}" 
                           class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition duration-200 text-center block font-medium">
                            <i class="fas fa-arrow-right mr-2"></i>Ajukan Pendaftaran
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
                    <i class="fas fa-exclamation-triangle text-yellow-500 text-2xl mb-3"></i>
                    <p class="text-yellow-800">Tidak ada IDUKA yang tersedia untuk pendaftaran saat ini.</p>
                </div>
            @endforelse
        </div>

        <!-- Back to Dashboard -->
        <div class="mt-8 text-center">
            <a href="{{ route('dashboard') }}" class="text-blue-500 hover:text-blue-600 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection