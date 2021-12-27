<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthSekolahController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:sekolah')->except('logout');
    }

    public function showLoginForm()
    {
        return view('sekolah/login');
    }

    public function login(Request $request)
    {
        config()->set('auth.defaults.guard', 'sekolah');

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $credential = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credential)) {
            Auth::guard('sekolah')->attempt($credential, $request->filled('remember'));
            return redirect()->intended(route('sekolah.home'));
        }

        return redirect()->back()->withInput($request->only('username', 'password'))->withErrors(['error' => ['Username atau password yang anda masukkan salah!']]);
    }

    public function logout(Request $request)
    {
        Auth::guard('sekolah')->logout();

        $request->session()->invalidate();

        return redirect('/sekolah');
    }
}