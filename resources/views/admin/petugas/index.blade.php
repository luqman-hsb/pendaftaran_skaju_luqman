@extends('layouts.admin')

@section('title', 'Manajemen Petugas - Sistem Akademik')

@section('content')
<div class="p-6">
    <!-- Header dengan Back to Dashboard -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center text-blue-500 hover:text-blue-600 mr-4 transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Petugas</h1>
        </div>
        <a href="{{ route('admin.petugas.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
            <i class="fas fa-plus mr-2"></i>Tambah Petugas
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

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                <span class="text-red-800">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-orange-100 rounded-lg mr-3">
                    <i class="fas fa-user-shield text-orange-500"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Petugas</p>
                    <p class="text-xl font-bold text-gray-800">{{ $petugas->total() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg mr-3">
                    <i class="fas fa-crown text-purple-500"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Super Admin</p>
                    <p class="text-xl font-bold text-gray-800">{{ $stats['superadmin'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg mr-3">
                    <i class="fas fa-user text-blue-500"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Petugas Biasa</p>
                    <p class="text-xl font-bold text-gray-800">{{ $stats['petugas'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg mr-3">
                    <i class="fas fa-user-check text-green-500"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Aktif Hari Ini</p>
                    <p class="text-xl font-bold text-gray-800">{{ $stats['aktif_hari_ini'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex-1">
                <form action="{{ route('admin.petugas.index') }}" method="GET">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               placeholder="Cari petugas...">
                    </div>
                </form>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">{{ $petugas->total() }} hasil ditemukan</span>
                @if(request('search'))
                    <a href="{{ route('admin.petugas.index') }}" class="text-blue-500 hover:text-blue-600 text-sm">
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petugas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terdaftar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($petugas as $index => $item)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ ($petugas->currentPage() - 1) * $petugas->perPage() + $index + 1 }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-user-shield text-orange-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $item->nama_lengkap }}</div>
                                        <div class="text-xs text-gray-500">ID: {{ $item->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->jabatan ?? 'Petugas' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($item->is_superadmin)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                        <i class="fas fa-crown mr-1 text-xs"></i> Super Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-user mr-1 text-xs"></i> Petugas
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->created_at->format('d/m/Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $item->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.petugas.edit', $item) }}" 
                                       class="text-blue-600 hover:text-blue-900 transition duration-200 p-2 rounded-lg hover:bg-blue-50"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($item->id !== Auth::guard('petugas')->id())
                                        <form action="{{ route('admin.petugas.destroy', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900 transition duration-200 p-2 rounded-lg hover:bg-red-50"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus petugas ini?')" 
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 cursor-not-allowed p-2 rounded-lg" title="Tidak dapat menghapus akun sendiri">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-user-shield text-4xl mb-3 text-gray-300"></i>
                                <p class="text-lg font-medium text-gray-600">Belum ada data petugas</p>
                                <p class="text-sm text-gray-500 mt-1">Mulai dengan menambahkan petugas pertama Anda</p>
                                <a href="{{ route('admin.petugas.create') }}" class="inline-flex items-center mt-4 text-blue-500 hover:text-blue-600 font-medium">
                                    <i class="fas fa-plus mr-2"></i>Tambah Petugas Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($petugas->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-white">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Menampilkan {{ $petugas->firstItem() }} - {{ $petugas->lastItem() }} dari {{ $petugas->total() }} hasil
                    </div>
                    <div>
                        {{ $petugas->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection