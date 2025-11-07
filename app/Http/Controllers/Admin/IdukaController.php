<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iduka;
use Illuminate\Http\Request;

class IdukaController extends Controller
{
    public function index(Request $request)
{
    $query = Iduka::query();

    // Search functionality
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nama_iduka', 'like', "%{$search}%")
              ->orWhere('bidang_usaha', 'like', "%{$search}%")
              ->orWhere('alamat', 'like', "%{$search}%")
              ->orWhere('kontak_person', 'like', "%{$search}%");
        });
    }

    $iduka = $query->latest()->paginate(10);
    
    return view('admin.iduka.index', compact('iduka'));
}

    public function create()
    {
        return view('admin.iduka.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_iduka' => 'required|string|max:255',
            'alamat' => 'required|string',
            'bidang_usaha' => 'required|string|max:255',
            'kontak_person' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'kuota' => 'required|integer|min:0',
        ]);

        Iduka::create($request->all());

        return redirect()->route('admin.iduka.index')->with('success', 'Data IDUKA berhasil ditambahkan.');
    }

    public function edit(Iduka $iduka)
    {
        return view('admin.iduka.edit', compact('iduka'));
    }

    public function update(Request $request, Iduka $iduka)
    {
        $request->validate([
            'nama_iduka' => 'required|string|max:255',
            'alamat' => 'required|string',
            'bidang_usaha' => 'required|string|max:255',
            'kontak_person' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'kuota' => 'required|integer|min:0',
        ]);

        $iduka->update($request->all());

        return redirect()->route('admin.iduka.index')->with('success', 'Data IDUKA berhasil diperbarui.');
    }

    public function destroy(Iduka $iduka)
    {
        $iduka->delete();
        return redirect()->route('admin.iduka.index')->with('success', 'Data IDUKA berhasil dihapus.');
    }
}