<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class AuthController extends Controller
{
    // Pindahkan deklarasi ke dalam method atau jadikan properti class
    private $users = [
        ['username' => 'pemerintah', 'password' => '123', 'role' => 'pemerintah'],
        ['username' => 'sekolah', 'password' => '123', 'role' => 'sekolah'],
        ['username' => 'siswa', 'password' => '123', 'role' => 'siswa'],
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

        foreach ($this->users as $user) {
            if (
                $user['username'] === $request->username &&
                $user['password'] === $request->password &&
                $user['role']     === $request->role
            ) {
                // Simpan ke session
                Session::put('login', true);
                Session::put('username', $user['username']);
                Session::put('role', $user['role']);

                // Redirect berdasarkan role
                switch ($user['role']) {
                    case 'sekolah':
                        return redirect('/dashboard/sekolah');
                    case 'siswa':
                        return redirect('/dashboard/siswa');
                    case 'pemerintah':
                        return redirect('/dashboard/pemerintah');
                }
            }
        }

        return back()->withErrors(['login' => 'Username, password, atau role salah!']);
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
