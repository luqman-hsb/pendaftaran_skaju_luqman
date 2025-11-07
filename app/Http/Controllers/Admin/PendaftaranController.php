<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function index(Request $request)
{
    $query = Pendaftaran::with(['siswa', 'iduka', 'petugas'])
        ->latest();

    // Filter by status if provided
    if ($request->status) {
        $query->where('status', $request->status);
    }

    // Filter history (sudah diproses)
    if ($request->has('history') && $request->history == 'true') {
        $query->whereIn('status', ['diterima', 'ditolak']);
    }

    // Search functionality
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->whereHas('siswa', function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            })->orWhereHas('iduka', function($q) use ($search) {
                $q->where('nama_iduka', 'like', "%{$search}%")
                  ->orWhere('bidang_usaha', 'like', "%{$search}%");
            });
        });
    }

    $pendaftaran = $query->paginate(10);

    // Stats for counters
    $stats = [
        'menunggu' => Pendaftaran::where('status', 'menunggu')->count(),
        'diterima' => Pendaftaran::where('status', 'diterima')->count(),
        'ditolak' => Pendaftaran::where('status', 'ditolak')->count(),
        'history' => Pendaftaran::whereIn('status', ['diterima', 'ditolak'])->count(),
    ];
        
    return view('admin.pendaftaran.index', compact('pendaftaran', 'stats'));
}

    public function show(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load(['siswa', 'iduka', 'petugas']);
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    public function approve(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'tanggal_berlaku' => 'required|date|after:today',
        ]);

        $pendaftaran->update([
            'status' => 'diterima',
            'tanggal_berlaku' => $request->tanggal_berlaku,
            'petugas_id' => Auth::guard('petugas')->id(),
            'catatan_penolakan' => null,
        ]);

        // Kurangi kuota IDUKA
        $iduka = $pendaftaran->iduka;
        if ($iduka->kuota > 0) {
            $iduka->decrement('kuota');
        }

        return redirect()->route('admin.pendaftaran.index')->with('success', 'Pendaftaran berhasil disetujui.');
    }

    public function reject(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'catatan_penolakan' => 'required|string|min:10',
        ]);

        $pendaftaran->update([
            'status' => 'ditolak',
            'petugas_id' => Auth::guard('petugas')->id(),
            'catatan_penolakan' => $request->catatan_penolakan,
            'tanggal_berlaku' => null,
        ]);

        return redirect()->route('admin.pendaftaran.index')->with('success', 'Pendaftaran berhasil ditolak.');
    }
}