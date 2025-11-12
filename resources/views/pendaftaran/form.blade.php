@extends('layouts.app')

@section('title', 'Form Pendaftaran PKL - Luqman\'s PKL')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-800">Form Pendaftaran PKL</h1>
            <p class="text-gray-600 mt-2">Lengkapi dan konfirmasi data pendaftaran Anda</p>
        </div>

        <!-- Student Information -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-user-graduate text-blue-500 mr-2"></i>
                Informasi Siswa
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">NIS</p>
                    <p class="font-medium">{{ Auth::user()->nis }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">NIK</p>
                    <p class="font-medium">{{ Auth::user()->nik }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-600">Nama Lengkap</p>
                    <p class="font-medium">{{ Auth::user()->nama_lengkap }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Kelas</p>
                    <p class="font-medium">{{ Auth::user()->kelas }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Jurusan</p>
                    <p class="font-medium">{{ Auth::user()->jurusan }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-600">Alamat</p>
                    <p class="font-medium">{{ Auth::user()->alamat }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">No. HP</p>
                    <p class="font-medium">{{ Auth::user()->no_hp }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="font-medium">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        <!-- IDUKA Information -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-building text-green-500 mr-2"></i>
                Informasi IDUKA
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Nama IDUKA</p>
                    <p class="font-medium">{{ $iduka->nama_iduka }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Bidang Usaha</p>
                    <p class="font-medium">{{ $iduka->bidang_usaha }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-600">Alamat Lengkap</p>
                    <p class="font-medium">{{ $iduka->alamat }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Kontak Person</p>
                    <p class="font-medium">{{ $iduka->kontak_person ?? 'Tidak tersedia' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">No. Telepon</p>
                    <p class="font-medium">{{ $iduka->no_telp ?? 'Tidak tersedia' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="font-medium">{{ $iduka->email ?? 'Tidak tersedia' }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-600">Kuota Tersedia</p>
                    <div class="flex items-center">
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mr-4">
                            <div class="bg-green-600 h-2.5 rounded-full" 
                                 style="width: {{ min(100, ($iduka->kuota / 10) * 100) }}%"></div>
                        </div>
                        <span class="font-medium text-green-600">{{ $iduka->kuota }} siswa</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Registration Form -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <form action="{{ route('pkl.store', $iduka) }}" method="POST" id="registrationForm">
                @csrf
                
                <!-- Confirmation Message -->
                <div class="mb-6">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                            <div>
                                <h3 class="font-semibold text-blue-800">Konfirmasi Pendaftaran</h3>
                                <p class="text-blue-700 text-sm mt-1">
                                    Anda akan mendaftar ke <strong>{{ $iduka->nama_iduka }}</strong> yang bergerak di bidang 
                                    <strong>{{ $iduka->bidang_usaha }}</strong>. Pastikan semua data di atas sudah benar sebelum mengajukan pendaftaran.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="mb-6">
                    <div class="flex items-start">
                        <input type="checkbox" id="agreeTerms" name="agreeTerms" class="mt-1 mr-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500" required>
                        <label for="agreeTerms" class="text-sm text-gray-700">
                            Saya menyatakan bahwa semua data yang saya berikan adalah benar dan saya bersedia mengikuti proses PKL di 
                            <strong>{{ $iduka->nama_iduka }}</strong> sesuai dengan ketentuan yang berlaku.
                        </label>
                    </div>
                    @error('agreeTerms')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Timer and Submit Button -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <a href="{{ route('pkl.daftar') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 font-medium transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar IDUKA
                    </a>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Timer Display -->
                        <div id="timerContainer" class="hidden">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-clock text-orange-500"></i>
                                <span class="text-sm font-medium text-gray-700">
                                    Tunggu <span id="countdown" class="font-bold text-orange-600">20</span> detik
                                </span>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" id="submitButton" 
                                class="inline-flex items-center bg-gray-400 text-white px-6 py-3 rounded-lg font-medium cursor-not-allowed transition duration-200"
                                disabled>
                            <i class="fas fa-paper-plane mr-2"></i>
                            <span id="buttonText">Ajukan Pendaftaran</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Important Notes -->
        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex items-start">
                <i class="fas fa-exclamation-triangle text-yellow-500 mt-1 mr-3"></i>
                <div>
                    <h3 class="font-semibold text-yellow-800">Penting!</h3>
                    <ul class="text-yellow-700 text-sm mt-1 list-disc list-inside space-y-1">
                        <li>Pastikan semua data siswa dan IDUKA sudah benar sebelum mengajukan pendaftaran</li>
                        <li>Pendaftaran yang sudah diajukan tidak dapat dibatalkan</li>
                        <li>Anda hanya dapat mendaftar ke satu IDUKA dalam satu waktu</li>
                        <li>Status pendaftaran akan diinformasikan melalui dashboard Anda</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const submitButton = document.getElementById('submitButton');
    const buttonText = document.getElementById('buttonText');
    const timerContainer = document.getElementById('timerContainer');
    const countdownElement = document.getElementById('countdown');
    const agreeTerms = document.getElementById('agreeTerms');
    
    let countdown = 20;
    let timerInterval;

    // Function to update button state
    function updateButtonState() {
        if (countdown > 0) {
            submitButton.disabled = true;
            submitButton.className = 'inline-flex items-center bg-gray-400 text-white px-6 py-3 rounded-lg font-medium cursor-not-allowed transition duration-200';
            timerContainer.classList.remove('hidden');
            countdownElement.textContent = countdown;
        } else {
            submitButton.disabled = false;
            submitButton.className = 'inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium transition duration-200';
            timerContainer.classList.add('hidden');
            clearInterval(timerInterval);
        }
    }

    // Start countdown
    timerInterval = setInterval(function() {
        countdown--;
        updateButtonState();
        
        if (countdown <= 0) {
            clearInterval(timerInterval);
        }
    }, 1000);

    // Initial state
    updateButtonState();

    // Add event listener for terms agreement
    agreeTerms.addEventListener('change', function() {
        if (countdown <= 0 && this.checked) {
            submitButton.disabled = false;
            submitButton.className = 'inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium transition duration-200';
        } else if (!this.checked) {
            submitButton.disabled = true;
            submitButton.className = 'inline-flex items-center bg-gray-400 text-white px-6 py-3 rounded-lg font-medium cursor-not-allowed transition duration-200';
        }
    });

    // Form submission handler
    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        if (!agreeTerms.checked) {
            e.preventDefault();
            alert('Anda harus menyetujui persyaratan sebelum mengajukan pendaftaran.');
            return;
        }
        
        if (countdown > 0) {
            e.preventDefault();
            alert('Harap tunggu sampai waktu countdown selesai sebelum mengajukan pendaftaran.');
            return;
        }

        // Show loading state
        submitButton.disabled = true;
        buttonText.textContent = 'Mengirim...';
        submitButton.className = 'inline-flex items-center bg-blue-400 text-white px-6 py-3 rounded-lg font-medium cursor-not-allowed transition duration-200';
    });
});
</script>

<style>
/* Additional professional styling */
.bg-blue-50 {
    background-color: #eff6ff;
}

.bg-yellow-50 {
    background-color: #fffbeb;
}

.border-blue-200 {
    border-color: #bfdbfe;
}

.border-yellow-200 {
    border-color: #fde68a;
}

/* Smooth transitions */
.transition {
    transition: all 0.3s ease;
}

/* Hover effects */
.hover\:bg-blue-600:hover {
    background-color: #2563eb;
}

.hover\:text-gray-800:hover {
    color: #1f2937;
}
</style>
@endsection