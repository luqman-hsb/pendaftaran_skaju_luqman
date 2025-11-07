<?php

namespace App\Http\Controllers;

use App\Models\Iduka;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    // Show list of iduka for registration
    public function showDaftarPKL()
    {
        $idukaList = Iduka::where('kuota', '>', 0)->get();
        return view('pendaftaran.daftar', compact('idukaList'));
    }

    // Show registration form for specific iduka
    public function showForm(Iduka $iduka)
    {
        // Check if student already has active PKL
        if (Auth::user()->hasActivePKL()) {
            return redirect()->route('dashboard')->with('error', 'Anda sudah memiliki PKL aktif.');
        }

        // Check if student already has pending registration for this iduka
        $existingRegistration = Pendaftaran::where('siswa_id', Auth::id())
            ->where('iduka_id', $iduka->id)
            ->where('status', 'menunggu')
            ->first();

        if ($existingRegistration) {
            return redirect()->route('dashboard')->with('info', 'Anda sudah mendaftar ke IDUKA ini dan sedang menunggu persetujuan.');
        }

        return view('pendaftaran.form', compact('iduka'));
    }

    // Process registration
    public function store(Request $request, Iduka $iduka)
{
    \Log::info('Store method called', [
        'siswa_id' => Auth::id(),
        'iduka_id' => $iduka->id,
        'iduka_name' => $iduka->nama_iduka,
        'request_data' => $request->all()
    ]);

    // Check if student already has active PKL
    if (Auth::user()->hasActivePKL()) {
        \Log::warning('Student already has active PKL', ['siswa_id' => Auth::id()]);
        return redirect()->route('dashboard')->with('error', 'Anda sudah memiliki PKL aktif.');
    }

    // Check if student already has pending registration for any iduka
    $existingRegistration = Pendaftaran::where('siswa_id', Auth::id())
        ->where('status', 'menunggu')
        ->first();

    if ($existingRegistration) {
        \Log::warning('Student has pending registration', [
            'siswa_id' => Auth::id(), 
            'existing_id' => $existingRegistration->id
        ]);
        return redirect()->route('dashboard')->with('info', 'Anda sudah memiliki pendaftaran yang sedang menunggu persetujuan.');
    }

    // Check if IDUKA still has quota
    if ($iduka->kuota <= 0) {
        \Log::warning('IDUKA quota full', ['iduka_id' => $iduka->id]);
        return redirect()->route('pkl.daftar')->with('error', 'Kuota IDUKA ini sudah penuh.');
    }

    try {
        \Log::info('Creating registration...');

        $pendaftaran = Pendaftaran::create([
            'siswa_id' => Auth::id(),
            'iduka_id' => $iduka->id,
            'tanggal_daftar' => now()->format('Y-m-d'),
            'status' => 'menunggu',
            'tanggal_berlaku' => null,
            'petugas_id' => null,
            'catatan_penolakan' => null,
        ]);

        \Log::info('Registration created successfully', ['pendaftaran_id' => $pendaftaran->id]);

        return redirect()->route('dashboard')->with('success', 'Pendaftaran PKL berhasil dikirim! Menunggu persetujuan petugas.');

    } catch (\Exception $e) {
        \Log::error('Error creating registration: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);
        
        return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim pendaftaran: ' . $e->getMessage());
    }
}

    // Show registration history
    public function history()
    {
        $pendaftaran = Pendaftaran::where('siswa_id', Auth::id())
            ->with('iduka')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pendaftaran.history', compact('pendaftaran'));
    }
}