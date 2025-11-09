@extends('layouts.admin')

@section('title', 'Dashboard Admin - Sistem Akademik')
@section('header-title', 'Dashboard Admin')

@section('content')
                <!-- Notifications -->
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span class="text-green-800">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="card-hover bg-white rounded-xl shadow-md p-6 border border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-lg mr-4">
                                <i class="fas fa-users text-blue-500 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Siswa</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_siswa'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-hover bg-white rounded-xl shadow-md p-6 border border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-lg mr-4">
                                <i class="fas fa-building text-green-500 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total IDUKA</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_iduka'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-hover bg-white rounded-xl shadow-md p-6 border border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 bg-yellow-100 rounded-lg mr-4">
                                <i class="fas fa-clipboard-list text-yellow-500 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Menunggu Review</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $stats['pendaftaran_menunggu'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-hover bg-white rounded-xl shadow-md p-6 border border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-100 rounded-lg mr-4">
                                <i class="fas fa-file-alt text-purple-500 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Pendaftaran</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_pendaftaran'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Pendaftaran Terbaru -->
                    <div class="bg-white rounded-xl shadow-md border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                                <i class="fas fa-clock mr-2 text-yellow-500"></i>
                                Pendaftaran Menunggu Review
                            </h2>
                        </div>
                        <div class="p-6">
                            @forelse($pendaftaranTerbaru as $pendaftaran)
                                <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800">{{ $pendaftaran->siswa->nama_lengkap }}</p>
                                        <p class="text-sm text-gray-600">{{ $pendaftaran->iduka->nama_iduka }}</p>
                                        <p class="text-xs text-gray-500">{{ $pendaftaran->created_at->diffForHumans() }}</p>
                                    </div>
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium">
                                        Menunggu
                                    </span>
                                </div>
                            @empty
                                <div class="text-center py-8 text-gray-500">
                                    <i class="fas fa-inbox text-3xl mb-3"></i>
                                    <p>Tidak ada pendaftaran yang menunggu review.</p>
                                </div>
                            @endforelse
                            
                            @if($pendaftaranTerbaru->count() > 0)
                                <div class="mt-4 text-center">
                                    <a href="{{ route('admin.pendaftaran.index', ['status' => 'menunggu']) }}" 
                                       class="inline-flex items-center text-blue-500 hover:text-blue-600 font-medium text-sm">
                                        Lihat Semua Pendaftaran
                                        <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Pendaftaran Ditangani -->
<div class="bg-white rounded-xl shadow-md border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
            <i class="fas fa-user-check mr-2 text-green-500"></i>
            Pendaftaran Ditangani oleh Anda
        </h2>
    </div>
    <div class="p-6">
        @forelse($pendaftaranDitangani as $pendaftaran)
            <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                <div class="flex-1">
                    <p class="font-medium text-gray-800">{{ $pendaftaran->siswa->nama_lengkap }}</p>
                    <p class="text-sm text-gray-600">{{ $pendaftaran->iduka->nama_iduka }}</p>
                    <p class="text-xs text-gray-500">{{ $pendaftaran->updated_at->diffForHumans() }}</p>
                </div>
                @if($pendaftaran->status == 'diterima')
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                        Diterima
                    </span>
                @elseif($pendaftaran->status == 'ditolak')
                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">
                        Ditolak
                    </span>
                @else
                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium">
                        Menunggu
                    </span>
                @endif
            </div>
        @empty
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-user-clock text-3xl mb-3"></i>
                <p>Belum ada pendaftaran yang ditangani.</p>
            </div>
        @endforelse
        
        @if($pendaftaranDitangani->count() > 0)
            <div class="mt-4 text-center">
                <a href="{{ route('admin.pendaftaran.index', ['history' => 'true']) }}" 
                   class="inline-flex items-center text-blue-500 hover:text-blue-600 font-medium text-sm">
                    Lihat Riwayat Lengkap
                    <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        @endif
    </div>
</div>
                </div>

                <!-- Quick Actions -->
<div class="mt-8 bg-white rounded-xl shadow-md border border-gray-200 p-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.pendaftaran.index') }}" class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center hover:bg-blue-100 transition duration-200">
            <i class="fas fa-clipboard-check text-blue-500 text-xl mb-2"></i>
            <p class="font-medium text-blue-800">Review Pendaftaran</p>
        </a>
        <a href="{{ route('admin.iduka.index') }}" class="bg-green-50 border border-green-200 rounded-lg p-4 text-center hover:bg-green-100 transition duration-200">
            <i class="fas fa-building text-green-500 text-xl mb-2"></i>
            <p class="font-medium text-green-800">Kelola IDUKA</p>
        </a>
        <a href="{{ route('admin.siswa.index') }}" class="bg-purple-50 border border-purple-200 rounded-lg p-4 text-center hover:bg-purple-100 transition duration-200">
            <i class="fas fa-users text-purple-500 text-xl mb-2"></i>
            <p class="font-medium text-purple-800">Data Siswa</p>
        </a>
        @if(Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->is_superadmin)
            <a href="{{ route('admin.petugas.index') }}" class="bg-orange-50 border border-orange-200 rounded-lg p-4 text-center hover:bg-orange-100 transition duration-200">
                <i class="fas fa-user-shield text-orange-500 text-xl mb-2"></i>
                <p class="font-medium text-orange-800">Manajemen Petugas</p>
            </a>
        @else
            <a href="#" class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                <i class="fas fa-chart-bar text-gray-500 text-xl mb-2"></i>
                <p class="font-medium text-gray-800">Laporan</p>
            </a>
        @endif
    </div>
</div>
@endsection
