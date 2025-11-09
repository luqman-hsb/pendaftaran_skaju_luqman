@extends('layouts.admin')

@section('title', 'Manajemen Pendaftaran PKL - Sistem Akademik')
@section('header-title', 'Manajemen Pendaftaran')


@section('content')
<div class="p-6">
    <!-- Header dengan Back to Dashboard -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Pendaftaran PKL</h1>
        </div>
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
                <div class="p-2 bg-blue-100 rounded-lg mr-3">
                    <i class="fas fa-clipboard-list text-blue-500"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total</p>
                    <p class="text-xl font-bold text-gray-800">{{ $pendaftaran->total() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg mr-3">
                    <i class="fas fa-clock text-yellow-500"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Menunggu</p>
                    <p class="text-xl font-bold text-gray-800">{{ $stats['menunggu'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg mr-3">
                    <i class="fas fa-check text-green-500"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Diterima</p>
                    <p class="text-xl font-bold text-gray-800">{{ $stats['diterima'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-red-100 rounded-lg mr-3">
                    <i class="fas fa-times text-red-500"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Ditolak</p>
                    <p class="text-xl font-bold text-gray-800">{{ $stats['ditolak'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs dan Search -->
<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <!-- Filter Tabs -->
        <div class="flex flex-wrap gap-2">
            <a href="{{ request()->fullUrlWithQuery(['status' => '', 'history' => '']) }}" 
               class="px-4 py-2 rounded-lg text-sm font-medium transition duration-200 {{ !request('status') && !request('history') ? 'bg-blue-500 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:text-gray-800' }}">
                Semua ({{ $pendaftaran->total() }})
            </a>
            <a href="{{ request()->fullUrlWithQuery(['status' => 'menunggu', 'history' => '']) }}" 
               class="px-4 py-2 rounded-lg text-sm font-medium transition duration-200 {{ request('status') == 'menunggu' ? 'bg-yellow-500 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:text-gray-800' }}">
                Menunggu ({{ $stats['menunggu'] ?? 0 }})
            </a>
            <a href="{{ request()->fullUrlWithQuery(['status' => 'diterima', 'history' => '']) }}" 
               class="px-4 py-2 rounded-lg text-sm font-medium transition duration-200 {{ request('status') == 'diterima' ? 'bg-green-500 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:text-gray-800' }}">
                Diterima ({{ $stats['diterima'] ?? 0 }})
            </a>
            <a href="{{ request()->fullUrlWithQuery(['status' => 'ditolak', 'history' => '']) }}" 
               class="px-4 py-2 rounded-lg text-sm font-medium transition duration-200 {{ request('status') == 'ditolak' ? 'bg-red-500 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:text-gray-800' }}">
                Ditolak ({{ $stats['ditolak'] ?? 0 }})
            </a>
            <!-- New History Filter -->
            <a href="{{ request()->fullUrlWithQuery(['history' => 'true', 'status' => '']) }}" 
               class="px-4 py-2 rounded-lg text-sm font-medium transition duration-200 {{ request('history') == 'true' ? 'bg-purple-500 text-white shadow-sm' : 'bg-gray-100 text-gray-600 hover:text-gray-800' }}">
                <i class="fas fa-history mr-1"></i> History ({{ $stats['history'] ?? 0 }})
            </a>
        </div>

        <!-- Search -->
        <div class="flex-1 max-w-md">
            <form action="{{ route('admin.pendaftaran.index') }}" method="GET">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           placeholder="Cari siswa atau IDUKA...">
                    <!-- Hidden fields to preserve filters -->
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    @if(request('history'))
                        <input type="hidden" name="history" value="{{ request('history') }}">
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Active Filters Info -->
    @if(request('status') || request('history') || request('search'))
        <div class="mt-4 pt-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600">Filter aktif:</span>
                    @if(request('status'))
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium 
                            {{ request('status') == 'menunggu' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ request('status') == 'diterima' ? 'bg-green-100 text-green-800' : '' }}
                            {{ request('status') == 'ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst(request('status')) }}
                            <a href="{{ request()->fullUrlWithQuery(['status' => null]) }}" class="ml-1 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif
                    @if(request('history') == 'true')
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-purple-100 text-purple-800">
                            History
                            <a href="{{ request()->fullUrlWithQuery(['history' => null]) }}" class="ml-1 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif
                    @if(request('search'))
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                            Pencarian: "{{ request('search') }}"
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="ml-1 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif
                </div>
                <a href="{{ route('admin.pendaftaran.index') }}" class="text-sm text-blue-500 hover:text-blue-600">
                    <i class="fas fa-times mr-1"></i> Clear semua
                </a>
            </div>
        </div>
    @endif
</div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IDUKA</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petugas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pendaftaran as $index => $item)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ ($pendaftaran->currentPage() - 1) * $pendaftaran->perPage() + $index + 1 }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-user-graduate text-blue-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $item->siswa->nama_lengkap }}</div>
                                        <div class="text-xs text-gray-500">{{ $item->siswa->nis }} • {{ $item->siswa->kelas ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-building text-green-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $item->iduka->nama_iduka }}</div>
                                        <div class="text-xs text-gray-500">{{ $item->iduka->bidang_usaha }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->tanggal_daftar->format('d/m/Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $item->tanggal_daftar->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($item->status == 'diterima')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1 text-xs"></i> Diterima
                                    </span>
                                @elseif($item->status == 'ditolak')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times mr-1 text-xs"></i> Ditolak
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1 text-xs"></i> Menunggu
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->petugas->nama_lengkap ?? '-' }}</div>
                                <div class="text-xs text-gray-500">
                                    @if($item->petugas)
                                        {{ $item->updated_at->format('d/m/Y') }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.pendaftaran.show', $item) }}" 
                                       class="text-blue-600 hover:text-blue-900 transition duration-200 p-2 rounded-lg hover:bg-blue-50"
                                       title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($item->status == 'menunggu')
                                        <button onclick="openApproveModal({{ $item->id }})" 
                                                class="text-green-600 hover:text-green-900 transition duration-200 p-2 rounded-lg hover:bg-green-50"
                                                title="Setujui">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button onclick="openRejectModal({{ $item->id }})" 
                                                class="text-red-600 hover:text-red-900 transition duration-200 p-2 rounded-lg hover:bg-red-50"
                                                title="Tolak">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-clipboard-list text-4xl mb-3 text-gray-300"></i>
                                <p class="text-lg font-medium text-gray-600">Belum ada data pendaftaran</p>
                                <p class="text-sm text-gray-500 mt-1">
                                    @if(request('search') || request('status'))
                                        Coba ubah pencarian atau filter Anda
                                    @else
                                        Siswa belum melakukan pendaftaran PKL
                                    @endif
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($pendaftaran->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-white">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Menampilkan {{ $pendaftaran->firstItem() }} - {{ $pendaftaran->lastItem() }} dari {{ $pendaftaran->total() }} hasil
                    </div>
                    <div>
                        {{ $pendaftaran->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Modal Approve -->
<div id="approveModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Setujui Pendaftaran</h3>
            <form id="approveForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="tanggal_berlaku" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Berlaku *</label>
                    <input type="date" id="tanggal_berlaku" name="tanggal_berlaku" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeApproveModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        Batal
                    </button>
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        Setujui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Reject -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Tolak Pendaftaran</h3>
            <form id="rejectForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="catatan_penolakan" class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan *</label>
                    <textarea id="catatan_penolakan" name="catatan_penolakan" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                              placeholder="Berikan alasan penolakan..." required></textarea>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeRejectModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        Batal
                    </button>
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openApproveModal(id) {
    document.getElementById('approveForm').action = `/admin/pendaftaran/${id}/approve`;
    document.getElementById('approveModal').classList.remove('hidden');
}

function closeApproveModal() {
    document.getElementById('approveModal').classList.add('hidden');
}

function openRejectModal(id) {
    document.getElementById('rejectForm').action = `/admin/pendaftaran/${id}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}

// Close modal when clicking outside
window.onclick = function(event) {
    const approveModal = document.getElementById('approveModal');
    const rejectModal = document.getElementById('rejectModal');
    
    if (event.target == approveModal) {
        closeApproveModal();
    }
    if (event.target == rejectModal) {
        closeRejectModal();
    }
}
</script>
@endsection