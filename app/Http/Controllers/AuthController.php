<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private $users = [
        [
            'username' => 'pemerintah',
            'password' => '123',
            'role' => 'pemerintah',
        ],
        [
            'username' => 'sekolah',
            'password' => '123',
            'role' => 'sekolah',
        ],
        [
            'username' => 'siswa',
            'password' => '123',
            'role' => 'siswa',
        ],
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
                Session::put('role', $user['role']);
                Session::put('username', $user['username']);
                return redirect('/dashboard');
            }
        }

        return redirect()->back()->withErrors(['login' => 'Username, password, atau role salah!']);
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}

