<?php

namespace App\Http\Controllers;

use App\Models\Iduka;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total_siswa' => Siswa::count(),
            'total_iduka' => Iduka::count(),
            'pendaftaran_diterima' => Pendaftaran::where('status', 'diterima')->count(),
            'tingkat_kepuasan' => 98, // Fixed value for satisfaction rate
        ];

        return view('home', compact('stats'));
    }
}
