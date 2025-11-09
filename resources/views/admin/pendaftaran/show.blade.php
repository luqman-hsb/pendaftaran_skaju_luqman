@extends('layouts.admin')

@section('title', 'Detail Pendaftaran - Sistem Akademik')

@section('content')
<div class="p-6">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.pendaftaran.index') }}" class="text-blue-500 hover:text-blue-600 mr-4">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Detail Pendaftaran PKL</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Data Siswa -->
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-user-graduate text-blue-500 mr-2"></i>
                Data Siswa
            </h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-600">Nama Lengkap</p>
                    <p class="font-medium text-gray-900">{{ $pendaftaran->siswa->nama_lengkap }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">NIS</p>
                    <p class="font-medium text-gray-900">{{ $pendaftaran->siswa->nis }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">NIK</p>
                    <p class="font-medium text-gray-900">{{ $pendaftaran->siswa->nik ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Kelas & Jurusan</p>
                    <p class="font-medium text-gray-900">
                        {{ $pendaftaran->siswa->kelas ?? '-' }} / {{ $pendaftaran->siswa->jurusan ?? '-' }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Alamat</p>
                    <p class="font-medium text-gray-900">{{ $pendaftaran->siswa->alamat ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="font-medium text-gray-900">{{ $pendaftaran->siswa->email ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">No. Telepon</p>
                    <p class="font-medium text-gray-900">{{ $pendaftaran->siswa->no_hp ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Status PKL</p>
                    @if($pendaftaran->siswa->hasActivePKL())
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i> Sudah Aktif
                        </span>
                    @elseif($pendaftaran->siswa->hasPendingRegistration())
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-clock mr-1"></i> Menunggu Persetujuan
                        </span>
                    @else
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            <i class="fas fa-times-circle mr-1"></i> Belum Daftar
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Data IDUKA -->
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-building text-green-500 mr-2"></i>
                Data IDUKA
            </h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-600">Nama IDUKA</p>
                    <p class="font-medium text-gray-900">{{ $pendaftaran->iduka->nama_iduka }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Bidang Usaha</p>
                    <p class="font-medium text-gray-900">{{ $pendaftaran->iduka->bidang_usaha }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Alamat</p>
                    <p class="font-medium text-gray-900">{{ $pendaftaran->iduka->alamat }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Kontak Person</p>
                    <p class="font-medium text-gray-900">{{ $pendaftaran->iduka->kontak_person ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Kuota Tersedia</p>
                    <p class="font-medium text-gray-900">{{ $pendaftaran->iduka->kuota }} siswa</p>
                </div>
            </div>
        </div>

        <!-- Status Pendaftaran -->
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 lg:col-span-2">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle text-purple-500 mr-2"></i>
                Status Pendaftaran
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <p class="text-sm text-gray-600">Tanggal Daftar</p>
                    <p class="font-medium text-gray-900">{{ $pendaftaran->tanggal_daftar->format('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Status</p>
                    @if($pendaftaran->status == 'diterima')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check mr-1"></i> Diterima
                        </span>
                    @elseif($pendaftaran->status == 'ditolak')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <i class="fas fa-times mr-1"></i> Ditolak
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-clock mr-1"></i> Menunggu
                        </span>
                    @endif
                </div>
                <div>
                    <p class="text-sm text-gray-600">Tanggal Berlaku</p>
                    <p class="font-medium text-gray-900">{{ $pendaftaran->tanggal_berlaku ? $pendaftaran->tanggal_berlaku->format('d F Y') : '-' }}</p>
                </div>
                @if($pendaftaran->petugas)
                <div>
                    <p class="text-sm text-gray-600">Ditangani Oleh</p>
                    <p class="font-medium text-gray-900">{{ $pendaftaran->petugas->nama_lengkap }}</p>
                </div>
                @endif
                @if($pendaftaran->catatan_penolakan)
                <div class="md:col-span-3">
                    <p class="text-sm text-gray-600">Catatan Penolakan</p>
                    <p class="font-medium text-gray-900">{{ $pendaftaran->catatan_penolakan }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    @if($pendaftaran->status == 'menunggu')
    <div class="mt-6 bg-white rounded-xl shadow-md border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h2>
        <div class="flex space-x-4">
            <button onclick="openApproveModal()" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center">
                <i class="fas fa-check mr-2"></i> Setujui
            </button>
            <button onclick="openRejectModal()" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center">
                <i class="fas fa-times mr-2"></i> Tolak
            </button>
        </div>
    </div>
    @endif
</div>

@if($pendaftaran->status == 'menunggu')
<!-- Modal Approve -->
<div id="approveModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Setujui Pendaftaran</h3>
            <form action="{{ route('admin.pendaftaran.approve', $pendaftaran) }}" method="POST">
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
            <form action="{{ route('admin.pendaftaran.reject', $pendaftaran) }}" method="POST">
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
function openApproveModal() {
    document.getElementById('approveModal').classList.remove('hidden');
}

function closeApproveModal() {
    document.getElementById('approveModal').classList.add('hidden');
}

function openRejectModal() {
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
@endif
@endsection
