<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::latest()->paginate(10);
        return view('admin.siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string|unique:table_siswa,nis|max:20',
            'nik' => 'required|string|unique:table_siswa,nik|max:20',
            'nama_lengkap' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:50',
            'jurusan' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:50',
            'email' => 'nullable|email|unique:table_siswa,email',
            'password' => 'required|string|min:6',
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis' => ['required', 'string', 'max:20', Rule::unique('table_siswa')->ignore($siswa->id)],
            'nik' => ['required', 'string', 'max:20', Rule::unique('table_siswa')->ignore($siswa->id)],
            'nama_lengkap' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:50',
            'jurusan' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:50',
            'email' => ['nullable', 'email', Rule::unique('table_siswa')->ignore($siswa->id)],
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'nis' => $request->nis,
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa->update($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}