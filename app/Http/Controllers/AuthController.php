<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserAuthVerifyRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
        $credentials = $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
        ]);
        
        if (Auth::guard('dosen')->attempt(['nidn' => $credentials['identifier'], 'password' => $credentials['password']])) {
            return redirect('/home');
        } elseif (Auth::guard('mahasiswa')->attempt(['nim' => $credentials['identifier'], 'password' => $credentials['password']])) {
            return redirect('/mahasiswa/home');
        } else {
            return redirect('/')->with('warning', 'NIDN/NIM atau Password Salah');
        }
    }
    

    public function logout()
    {
        if (Auth::guard('mahasiswa')->check()) {
            Auth::guard('mahasiswa')->logout();
            return redirect('/');
        } elseif (Auth::guard('dosen')->check()) {
            Auth::guard('dosen')->logout();
            return redirect('/');
        } else {
            return redirect('/');
        }
    }

    public function proseslogoutadmin()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect('/panel');
        }
    }

    public function adminVerify(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect('/panel/home');
        } else {
            return redirect('/panel')->with(['warning' => 'Username / Password salah']);
        }
    }


}
