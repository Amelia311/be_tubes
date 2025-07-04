<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
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
            'role' => 'required',
        ]);

        foreach ($this->users as $user) {
            if (
                $user['username'] === $request->username &&
                $user['password'] === $request->password &&
                $user['role'] === $request->role
            ) {
                Session::put('login', true);
                Session::put('username', $user['username']);
                Session::put('role', $user['role']);

                if (isset($user['nisn'])) {
                    Session::put('nisn', $user['nisn']);
                }
                

                 // Langsung mengarahkan halaman sesuai role
                if ($user['role'] === 'sekolah') {
                    return redirect('/dashboard/sekolah');
                } elseif ($user['role'] === 'siswa') {
                    return redirect('/dashboard/siswa');
                } elseif ($user['role'] === 'pemerintah') {
                    return redirect('/dashboard/pemerintah');
                }
                
            }
        }

        return back()->withErrors(['login' => 'Username, password, atau role salah!']);
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
