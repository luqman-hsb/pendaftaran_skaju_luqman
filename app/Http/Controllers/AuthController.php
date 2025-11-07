<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Show registration form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle login
    public function login(Request $request)
{
    \Log::info('=== LOGIN ATTEMPT START ===');
    \Log::info('Input NIS:', ['nis' => $request->nis]);

    $validator = Validator::make($request->all(), [
        'nis' => 'required|string',
        'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
        \Log::warning('Validation failed', $validator->errors()->toArray());
        return back()->withErrors($validator)->withInput();
    }

    $credentials = $request->only('nis', 'password');

    // Check if user exists with NIS
    $siswa = Siswa::where('nis', $credentials['nis'])->first();

    \Log::info('User found:', [
        'exists' => !is_null($siswa),
        'id' => $siswa ? $siswa->id : null,
        'name' => $siswa ? $siswa->nama_lengkap : null
    ]);

    if ($siswa && Hash::check($credentials['password'], $siswa->password)) {
        \Log::info('Password verified, attempting login...');
        
        // Coba login dengan berbagai approach
        Auth::guard('web')->login($siswa);
        $request->session()->regenerate();

        \Log::info('After login check:', [
            'auth_check' => Auth::check(),
            'auth_user' => Auth::user() ? Auth::user()->id : null,
            'session_id' => session()->getId()
        ]);

        // Coba redirect tanpa intended
        \Log::info('Redirecting to dashboard...');
        return redirect('/dashboard');
    }

    \Log::warning('Login failed - invalid credentials');
    return back()->withErrors([
        'nis' => 'NIS atau password salah.',
    ])->withInput();
}

    // Handle registration
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|string|unique:table_siswa,nis|max:20',
            'nik' => 'required|string|unique:table_siswa,nik|max:20',
            'nama_lengkap' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:50',
            'jurusan' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:50',
            'email' => 'nullable|email|unique:table_siswa,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $siswa = Siswa::create([
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

        Auth::guard('web')->login($siswa);
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}