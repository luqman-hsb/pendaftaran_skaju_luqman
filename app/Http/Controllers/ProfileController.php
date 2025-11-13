<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // Show edit profile form
    public function edit()
    {
        $siswa = Auth::user();
        return view('profile.edit', compact('siswa'));
    }

    // Update profile
    public function update(Request $request)
    {
        $siswa = Auth::user();

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:50',
            'jurusan' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:50',
            'email' => ['nullable', 'email', Rule::unique('table_siswa')->ignore($siswa->id)],
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ];

        // Update password if provided
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa->update($data);

        return redirect()->route('dashboard')->with('success', 'Profil berhasil diperbarui.');
    }

    // Delete account
    public function destroy(Request $request)
    {
        $siswa = Auth::user();
        $siswa->delete();
        Auth::logout();

        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }
}
