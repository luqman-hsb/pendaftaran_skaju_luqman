<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftaran = Pendaftaran::with(['siswa', 'iduka', 'petugas'])
            ->latest()
            ->paginate(10);
            
        return view('admin.pendaftaran.index', compact('pendaftaran'));
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