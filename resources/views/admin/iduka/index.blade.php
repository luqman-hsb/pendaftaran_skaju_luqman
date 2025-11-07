@extends('layouts.admin')

@section('title', 'Manajemen IDUKA - Sistem Akademik')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen IDUKA</h1>
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
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama IDUKA</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bidang Usaha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kuota</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($iduka as $item)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $item->nama_iduka }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->bidang_usaha }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs truncate">{{ $item->alamat }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $item->kuota }} siswa
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->kontak_person ?? '-' }}</div>
                                <div class="text-sm text-gray-500">{{ $item->no_telp ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.iduka.edit', $item) }}" class="text-blue-600 hover:text-blue-900 transition duration-200" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.iduka.destroy', $item) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition duration-200" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus IDUKA ini?')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-building text-3xl mb-3"></i>
                                <p>Belum ada data IDUKA.</p>
                                <a href="{{ route('admin.iduka.create') }}" class="text-blue-500 hover:text-blue-600 mt-2 inline-block">
                                    Tambah IDUKA pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($iduka->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-white">
                {{ $iduka->links() }}
            </div>
        @endif
    </div>
</div>
@endsection