@extends('layouts.app')

@section('title', 'Riwayat PKL - Luqman\'s PKL')

@section('content')
<nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-graduation-cap text-blue-600 text-2xl mr-3"></i>
                        <span class="text-xl font-semibold text-gray-800">Luqman's PKL</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 transition duration-200">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <span class="text-gray-700">Halo, {{ Auth::user()->nama_lengkap ?? 'Siswa' }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-800">Riwayat Pendaftaran PKL</h1>
            <p class="text-gray-600 mt-2">Lihat sejarah dan perkembangan pendaftaran Praktik Kerja Lapangan Anda</p>
        </div>

        <!-- Stats Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 text-center">
                <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full mx-auto mb-3">
                    <i class="fas fa-paper-plane text-blue-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Total Pendaftaran</h3>
                <p class="text-2xl font-bold text-blue-600 mt-2">{{ $pendaftaran->count() }}</p>
            </div>
            
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 text-center">
                <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full mx-auto mb-3">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Diterima</h3>
                <p class="text-2xl font-bold text-green-600 mt-2">
                    {{ $pendaftaran->where('status', 'diterima')->count() }}
                </p>
            </div>
            
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 text-center">
                <div class="flex items-center justify-center w-12 h-12 bg-yellow-100 rounded-full mx-auto mb-3">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Menunggu</h3>
                <p class="text-2xl font-bold text-yellow-600 mt-2">
                    {{ $pendaftaran->where('status', 'menunggu')->count() }}
                </p>
            </div>
        </div>

        <!-- Timeline Section -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-stream text-purple-500 mr-2"></i>
                Timeline Pendaftaran
            </h2>
            
            <div class="relative">
                <!-- Timeline line -->
                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                
                <div class="space-y-8">
                    @forelse($pendaftaran as $index => $daftar)
                    <div class="relative flex items-start">
                        <!-- Timeline dot -->
                        <div class="absolute left-4 mt-2 -ml-1.5">
                            @if($daftar->status == 'diterima')
                                <div class="w-4 h-4 bg-green-500 rounded-full border-2 border-white shadow"></div>
                            @elseif($daftar->status == 'ditolak')
                                <div class="w-4 h-4 bg-red-500 rounded-full border-2 border-white shadow"></div>
                            @else
                                <div class="w-4 h-4 bg-yellow-500 rounded-full border-2 border-white shadow"></div>
                            @endif
                        </div>
                        
                        <!-- Content -->
                        <div class="ml-12 flex-1">
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-3">
                                    <div>
                                        <h3 class="font-semibold text-gray-800 text-lg">
                                            {{ $daftar->iduka->nama_iduka }}
                                        </h3>
                                        <p class="text-gray-600 text-sm">{{ $daftar->iduka->bidang_usaha }}</p>
                                    </div>
                                    <div class="mt-2 md:mt-0">
                                        @if($daftar->status == 'diterima')
                                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                                <i class="fas fa-check-circle mr-1"></i>Diterima
                                            </span>
                                        @elseif($daftar->status == 'ditolak')
                                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                                <i class="fas fa-times-circle mr-1"></i>Ditolak
                                            </span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                                <i class="fas fa-clock mr-1"></i>Menunggu
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <p class="text-gray-600">Tanggal Daftar</p>
                                        <p class="font-medium text-gray-800">
                                            <i class="fas fa-calendar-alt mr-2 text-blue-500"></i>
                                            {{ $daftar->tanggal_daftar->format('d F Y') }}
                                        </p>
                                    </div>
                                    
                                    @if($daftar->tanggal_berlaku)
                                    <div>
                                        <p class="text-gray-600">Tanggal Berlaku</p>
                                        <p class="font-medium text-gray-800">
                                            <i class="fas fa-calendar-check mr-2 text-green-500"></i>
                                            {{ $daftar->tanggal_berlaku->format('d F Y') }}
                                        </p>
                                    </div>
                                    @endif
                                    
                                    @if($daftar->petugas_id)
                                    <div>
                                        <p class="text-gray-600">Disetujui Oleh</p>
                                        <p class="font-medium text-gray-800">
                                            <i class="fas fa-user-shield mr-2 text-purple-500"></i>
                                            Petugas
                                        </p>
                                    </div>
                                    @endif
                                    
                                    @if($daftar->catatan_penolakan)
                                    <div class="md:col-span-2">
                                        <p class="text-gray-600">Catatan</p>
                                        <p class="font-medium text-gray-800 bg-red-50 border border-red-200 rounded px-3 py-2 mt-1">
                                            <i class="fas fa-comment-alt mr-2 text-red-500"></i>
                                            {{ $daftar->catatan_penolakan }}
                                        </p>
                                    </div>
                                    @endif
                                </div>
                                
                                <!-- Progress Steps -->
                                <div class="mt-4">
                                    <div class="flex items-center justify-between text-xs text-gray-500 mb-2">
                                        <span>Status Proses</span>
                                        <span>
                                            @if($daftar->status == 'diterima') Selesai
                                            @elseif($daftar->status == 'ditolak') Ditolak
                                            @elseif($daftar->status == 'menunggu') Dalam Review
                                            @endif
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        @if($daftar->status == 'diterima')
                                            <div class="bg-green-600 h-2 rounded-full w-full"></div>
                                        @elseif($daftar->status == 'ditolak')
                                            <div class="bg-red-600 h-2 rounded-full w-full"></div>
                                        @else
                                            <div class="bg-yellow-600 h-2 rounded-full w-1/2"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <div class="flex justify-center mb-4">
                            <i class="fas fa-inbox text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-600 mb-2">Belum ada riwayat pendaftaran</h3>
                        <p class="text-gray-500 mb-4">Anda belum pernah mendaftar PKL sebelumnya.</p>
                        <a href="{{ route('pkl.daftar') }}" class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                            <i class="fas fa-plus mr-2"></i>Daftar PKL Sekarang
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Detailed Table (Alternative View) -->
        @if($pendaftaran->count() > 0)
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-table text-blue-500 mr-2"></i>
                Tabel Detail Pendaftaran
            </h2>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                IDUKA
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Daftar
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Berlaku
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Catatan
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pendaftaran as $daftar)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">{{ $daftar->iduka->nama_iduka }}</div>
                                    <div class="text-sm text-gray-500">{{ $daftar->iduka->bidang_usaha }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $daftar->tanggal_daftar->format('d F Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($daftar->status == 'diterima')
                                        <span class="inline-flex items-center bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                                            <i class="fas fa-check-circle mr-1"></i>Diterima
                                        </span>
                                    @elseif($daftar->status == 'ditolak')
                                        <span class="inline-flex items-center bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">
                                            <i class="fas fa-times-circle mr-1"></i>Ditolak
                                        </span>
                                    @else
                                        <span class="inline-flex items-center bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium">
                                            <i class="fas fa-clock mr-1"></i>Menunggu
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $daftar->tanggal_berlaku ? $daftar->tanggal_berlaku->format('d F Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 max-w-xs">
                                    @if($daftar->catatan_penolakan)
                                        <div class="bg-red-50 border border-red-200 rounded px-3 py-2">
                                            <i class="fas fa-comment-alt mr-2 text-red-500"></i>
                                            {{ $daftar->catatan_penolakan }}
                                        </div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        {{-- <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition duration-200 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Dashboard
            </a>
            @if($pendaftaran->where('status', 'menunggu')->count() == 0)
            <a href="{{ route('pkl.daftar') }}" class="inline-flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition duration-200 font-medium">
                <i class="fas fa-plus mr-2"></i>Ajukan Pendaftaran Baru
            </a>
            @endif
        </div> --}}

        <!-- Info Box -->
        @if($pendaftaran->where('status', 'menunggu')->count() > 0)
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                <div>
                    <h3 class="font-semibold text-blue-800">Informasi</h3>
                    <p class="text-blue-700 text-sm mt-1">
                        Anda memiliki {{ $pendaftaran->where('status', 'menunggu')->count() }} pendaftaran yang sedang menunggu persetujuan. 
                        Tunggu konfirmasi dari petugas sebelum mengajukan pendaftaran baru.
                    </p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
/* Smooth transitions */
.transition {
    transition: all 0.3s ease;
}

/* Hover effects */
.hover\:bg-gray-50:hover {
    background-color: #f9fafb;
}

/* Custom scrollbar for table */
.overflow-x-auto::-webkit-scrollbar {
    height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>
@endsection