@extends('layouts.admin')

@section('title', 'Manajemen Petugas - Sistem Akademik')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Petugas</h1>
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
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
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
                    <p class="text-xl font-bold text-gray-800">{{ $petugas->where('is_superadmin', true)->count() }}</p>
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
                    <p class="text-xl font-bold text-gray-800">{{ $petugas->where('is_superadmin', false)->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($petugas as $item)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $item->nama_lengkap }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->jabatan ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($item->is_superadmin)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        <i class="fas fa-crown mr-1"></i> Super Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-user mr-1"></i> Petugas
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.petugas.edit', $item) }}" class="text-blue-600 hover:text-blue-900 transition duration-200" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($item->id !== Auth::guard('petugas')->id())
                                        <form action="{{ route('admin.petugas.destroy', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 transition duration-200" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus petugas ini?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 cursor-not-allowed" title="Tidak dapat menghapus akun sendiri">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-user-shield text-3xl mb-3"></i>
                                <p>Belum ada data petugas.</p>
                                <a href="{{ route('admin.petugas.create') }}" class="text-blue-500 hover:text-blue-600 mt-2 inline-block">
                                    Tambah petugas pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($petugas->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-white">
                {{ $petugas->links() }}
            </div>
        @endif
    </div>
</div>
@endsection