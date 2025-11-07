@extends('layouts.admin')

@section('title', 'Manajemen IDUKA - Sistem Akademik')

@section('content')
<div class="p-6">
    <!-- Header dengan Back to Dashboard -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center text-blue-500 hover:text-blue-600 mr-4 transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Manajemen IDUKA</h1>
        </div>
        <a href="{{ route('admin.iduka.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
            <i class="fas fa-plus mr-2"></i>Tambah IDUKA
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                <span class="text-green-800">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg mr-3">
                    <i class="fas fa-building text-green-500"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total IDUKA</p>
                    <p class="text-xl font-bold text-gray-800">{{ $iduka->total() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg mr-3">
                    <i class="fas fa-users text-blue-500"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Kuota</p>
                    <p class="text-xl font-bold text-gray-800">{{ $iduka->sum('kuota') }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg mr-3">
                    <i class="fas fa-chart-line text-purple-500"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Kuota Rata-rata</p>
                    <p class="text-xl font-bold text-gray-800">{{ round($iduka->avg('kuota')) }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-orange-100 rounded-lg mr-3">
                    <i class="fas fa-industry text-orange-500"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Bidang Usaha</p>
                    <p class="text-xl font-bold text-gray-800">{{ $iduka->pluck('bidang_usaha')->unique()->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex-1">
                <form action="{{ route('admin.iduka.index') }}" method="GET">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               placeholder="Cari IDUKA...">
                    </div>
                </form>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">{{ $iduka->total() }} hasil ditemukan</span>
                @if(request('search'))
                    <a href="{{ route('admin.iduka.index') }}" class="text-blue-500 hover:text-blue-600 text-sm">
                        <i class="fas fa-times mr-1"></i> Clear
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama IDUKA</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bidang Usaha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kuota</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($iduka as $index => $item)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ ($iduka->currentPage() - 1) * $iduka->perPage() + $index + 1 }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-building text-blue-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $item->nama_iduka }}</div>
                                        <div class="text-xs text-gray-500">ID: {{ $item->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->bidang_usaha }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $item->alamat }}">
                                    {{ $item->alamat }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $item->kuota > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    <i class="fas fa-users mr-1 text-xs"></i>
                                    {{ $item->kuota }} siswa
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->kontak_person ?? '-' }}</div>
                                <div class="text-sm text-gray-500">{{ $item->no_telp ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.iduka.edit', $item) }}" 
                                       class="text-blue-600 hover:text-blue-900 transition duration-200 p-2 rounded-lg hover:bg-blue-50"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.iduka.destroy', $item) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 transition duration-200 p-2 rounded-lg hover:bg-red-50"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus IDUKA ini?')" 
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-building text-4xl mb-3 text-gray-300"></i>
                                <p class="text-lg font-medium text-gray-600">Belum ada data IDUKA</p>
                                <p class="text-sm text-gray-500 mt-1">Mulai dengan menambahkan IDUKA pertama Anda</p>
                                <a href="{{ route('admin.iduka.create') }}" class="inline-flex items-center mt-4 text-blue-500 hover:text-blue-600 font-medium">
                                    <i class="fas fa-plus mr-2"></i>Tambah IDUKA Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($iduka->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-white">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Menampilkan {{ $iduka->firstItem() }} - {{ $iduka->lastItem() }} dari {{ $iduka->total() }} hasil
                    </div>
                    <div>
                        {{ $iduka->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection