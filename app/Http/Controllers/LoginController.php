<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check())
            return redirect()->route('admin.dashboard');
        else
            return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->route('admin.dashboard');
        }
        else
            return redirect()->route('admin.login')->with('status', 'Login failed. Please try again');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to('/');
    }
}
