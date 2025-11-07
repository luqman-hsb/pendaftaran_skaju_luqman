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
        // Validation
        $request->validate([
            'motivasi' => 'required|string|min:10',
        ]);

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

        // Create registration
        Pendaftaran::create([
            'siswa_id' => Auth::id(),
            'iduka_id' => $iduka->id,
            'tanggal_daftar' => now(),
            'status' => 'menunggu',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pendaftaran PKL berhasil dikirim! Menunggu persetujuan petugas.');
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