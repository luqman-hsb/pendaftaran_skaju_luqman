<?php

namespace App\Http\Controllers;

use App\Models\Iduka;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa = Auth::user();
        $activePKL = $siswa->getActivePKL();
        $pendingRegistration = $siswa->getPendingRegistration(); // Ganti dari hasPendingRegistration()

        return view('dashboard', compact('siswa', 'activePKL', 'pendingRegistration'));
    }
}
