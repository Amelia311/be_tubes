<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    // Pindahkan deklarasi ke dalam method atau jadikan properti class
    private $users = [
        ['username' => 'pemerintah', 'password' => '123', 'role' => 'pemerintah'],
        ['username' => 'sekolah', 'password' => '123', 'role' => 'sekolah'],
        ['username' => 'siswa', 'password' => '123', 'role' => 'siswa', 'nisn' => '1234567890']
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
    
        if ($request->role === 'siswa') {
            // Login siswa: cek ke database
            $siswa = Siswa::where('nisn', $request->username)->first();
    
            if ($siswa && Hash::check($request->password, $siswa->password)) {
                Session::put('login', true);
                Session::put('username', $siswa->nama);
                Session::put('role', 'siswa');
                Session::put('nisn', $siswa->nisn);
    
                return redirect('/dashboard/siswa');
            } else {
                return back()->withErrors(['login' => 'NISN atau password salah!']);
            }
        }
    
        // Admin & pemerintah tetap pakai array
        foreach ($this->users as $user) {
            if (
                $user['username'] === $request->username &&
                $user['password'] === $request->password &&
                $user['role']     === $request->role
            ) {
                Session::put('login', true);
                Session::put('username', $user['username']);
                Session::put('role', $user['role']);
    
                if (isset($user['nisn'])) {
                    Session::put('nisn', $user['nisn']);
                }
    
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
    

    // public function logout()
    // {
    //     Session::flush();
    //     return redirect('/login')->with('success', 'Anda telah logout.');
    // }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Anda telah logout.'); // atau ke halaman login
    }

}
