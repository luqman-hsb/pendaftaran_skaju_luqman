<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\Iduka;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_siswa' => Siswa::count(),
            'total_iduka' => Iduka::count(),
            'total_pendaftaran' => Pendaftaran::count(),
            'pendaftaran_menunggu' => Pendaftaran::where('status', 'menunggu')->count(),
            'pendaftaran_diterima' => Pendaftaran::where('status', 'diterima')->count(),
            'pendaftaran_ditolak' => Pendaftaran::where('status', 'ditolak')->count(),
        ];

        // Pendaftaran terbaru untuk ditinjau
        $pendaftaranTerbaru = Pendaftaran::with(['siswa', 'iduka'])
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Pendaftaran yang ditangani oleh petugas ini
        $pendaftaranDitangani = Pendaftaran::with(['siswa', 'iduka'])
            ->where('petugas_id', Auth::guard('petugas')->id())
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'pendaftaranTerbaru', 'pendaftaranDitangani'));
    }
}
