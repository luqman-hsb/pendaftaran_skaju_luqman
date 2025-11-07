<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PetugasController extends Controller
{
    public function index(Request $request)
{
    $query = Petugas::query();

    // Search functionality
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nama_lengkap', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('jabatan', 'like', "%{$search}%");
        });
    }

    $petugas = $query->latest()->paginate(10);

    // Stats for counters
    $stats = [
        'superadmin' => Petugas::where('is_superadmin', true)->count(),
        'petugas' => Petugas::where('is_superadmin', false)->count(),
        'aktif_hari_ini' => Petugas::whereDate('created_at', today())->count(),
    ];

    return view('admin.petugas.index', compact('petugas', 'stats'));
}

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'email' => 'required|email|unique:table_petugas,email',
            'password' => 'required|string|min:6',
            'is_superadmin' => 'boolean',
        ]);

        Petugas::create([
            'nama_lengkap' => $request->nama_lengkap,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_superadmin' => $request->is_superadmin ?? false,
        ]);

        return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil ditambahkan.');
    }

    public function edit(Petugas $petugas)
    {
        return view('admin.petugas.edit', compact('petugas'));
    }

    public function update(Request $request, Petugas $petugas)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'email' => ['required', 'email', Rule::unique('table_petugas')->ignore($petugas->id)],
            'password' => 'nullable|string|min:6',
            'is_superadmin' => 'boolean',
        ]);

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'is_superadmin' => $request->is_superadmin ?? false,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $petugas->update($data);

        return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil diperbarui.');
    }

    public function destroy(Petugas $petugas)
    {
        // Cegah penghapusan diri sendiri
        if ($petugas->id === Auth::guard('petugas')->id()) {
            return redirect()->route('admin.petugas.index')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $petugas->delete();
        return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil dihapus.');
    }
}