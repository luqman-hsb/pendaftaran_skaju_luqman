@extends('layouts.admin')

@section('title', 'Manajemen Pendaftaran PKL - Sistem Akademik')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Pendaftaran PKL</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                <span class="text-green-800">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Filter Tabs -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
        <div class="flex space-x-4">
            <a href="{{ request()->fullUrlWithQuery(['status' => '']) }}" 
               class="px-4 py-2 rounded-lg {{ !request('status') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:text-gray-800' }} transition duration-200">
                Semua ({{ $pendaftaran->total() }})
            </a>
            <a href="{{ request()->fullUrlWithQuery(['status' => 'menunggu']) }}" 
               class="px-4 py-2 rounded-lg {{ request('status') == 'menunggu' ? 'bg-yellow-500 text-white' : 'text-gray-600 hover:text-gray-800' }} transition duration-200">
                Menunggu ({{ $pendaftaran->where('status', 'menunggu')->count() }})
            </a>
            <a href="{{ request()->fullUrlWithQuery(['status' => 'diterima']) }}" 
               class="px-4 py-2 rounded-lg {{ request('status') == 'diterima' ? 'bg-green-500 text-white' : 'text-gray-600 hover:text-gray-800' }} transition duration-200">
                Diterima ({{ $pendaftaran->where('status', 'diterima')->count() }})
            </a>
            <a href="{{ request()->fullUrlWithQuery(['status' => 'ditolak']) }}" 
               class="px-4 py-2 rounded-lg {{ request('status') == 'ditolak' ? 'bg-red-500 text-white' : 'text-gray-600 hover:text-gray-800' }} transition duration-200">
                Ditolak ({{ $pendaftaran->where('status', 'ditolak')->count() }})
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IDUKA</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petugas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pendaftaran as $item)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $item->siswa->nama_lengkap }}</div>
                                <div class="text-sm text-gray-500">{{ $item->siswa->nis }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $item->iduka->nama_iduka }}</div>
                                <div class="text-sm text-gray-500">{{ $item->iduka->bidang_usaha }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->tanggal_daftar->format('d/m/Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($item->status == 'diterima')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i> Diterima
                                    </span>
                                @elseif($item->status == 'ditolak')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times mr-1"></i> Ditolak
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i> Menunggu
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->petugas->nama_lengkap ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.pendaftaran.show', $item) }}" class="text-blue-600 hover:text-blue-900 transition duration-200" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($item->status == 'menunggu')
                                        <button onclick="openApproveModal({{ $item->id }})" class="text-green-600 hover:text-green-900 transition duration-200" title="Setujui">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button onclick="openRejectModal({{ $item->id }})" class="text-red-600 hover:text-red-900 transition duration-200" title="Tolak">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-clipboard-list text-3xl mb-3"></i>
                                <p>Belum ada data pendaftaran.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($pendaftaran->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-white">
                {{ $pendaftaran->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Modal Approve -->
<div id="approveModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
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
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
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