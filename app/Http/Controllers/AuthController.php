<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Siswa;

class AuthController extends Controller
{
    // Akun statis untuk pemerintah dan sekolah
    private $users = [
        ['username' => 'pemerintah', 'password' => '123', 'role' => 'pemerintah'],
        ['username' => 'sekolah', 'password' => '123', 'role' => 'sekolah'],
    ];

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role'     => 'required',
        ]);

        // ====== LOGIN UNTUK SISWA ======
        if ($request->role === 'siswa') {
            $siswa = Siswa::where('nisn', $request->username)->first();

            if ($siswa) {
                $passwordValid = false;

                // Cek apakah password sudah di-hash (bcrypt)
                if (
                    (Str::startsWith($siswa->password, '$2y$') || Str::startsWith($siswa->password, '$2b$')) &&
                    Hash::check($request->password, $siswa->password)
                ) {
                    $passwordValid = true;
                }

                // Cek juga jika password masih dalam plain text
                if ($request->password === $siswa->password) {
                    $passwordValid = true;
                }

                if ($passwordValid) {
                    // Simpan sesi login
                    Session::put('login', true);
                    Session::put('username', $siswa->nama);
                    Session::put('role', 'siswa');
                    Session::put('nisn', $siswa->nisn);

                    return redirect('/dashboard/siswa');
                } else {
                    return back()->withErrors(['login' => 'Password salah!']);
                }
            } else {
                return back()->withErrors(['login' => 'NISN tidak ditemukan.']);
            }
        }

        // ====== LOGIN UNTUK ADMIN SEKOLAH & PEMERINTAH ======
        foreach ($this->users as $user) {
            if (
                $user['username'] === $request->username &&
                $user['password'] === $request->password &&
                $user['role']     === $request->role
            ) {
                Session::put('login', true);
                Session::put('username', $user['username']);
                Session::put('role', $user['role']);

                switch ($user['role']) {
                    case 'sekolah':
                        return redirect('/dashboard/sekolah');
                    case 'pemerintah':
                        return redirect('/dashboard/pemerintah');
                }
            }
        }

        return back()->withErrors(['login' => 'Username, password, atau role salah!']);
    }

    public function logout(Request $request)
    {
        auth()->logout(); // hanya berfungsi jika pakai Auth bawaan Laravel
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
