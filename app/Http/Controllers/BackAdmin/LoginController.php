<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show login page
     */
    public function index()
    {
        return view('backadmin.auth.login');
    }
  
    /**
     * Login user into the system
     */
    public function login(Request $req)
    {
        if (Auth::attempt(['username' => $req->username, 'password' => $req->password] , $req->remember)) {
            $req->session()->regenerate();
            return redirect()->intended('account');
        }

        return back()->withErrors([
            'username' => 'Username atau password tidak cocok dengan data yang ada',
        ]);
    }

    /**
     * Logout user
     */
    public function logout(Request $req)
    {
        Auth::logout();

        $req->session()->invalidate();
    
        $req->session()->regenerateToken();
    
        return redirect()->route('backadmin.auth.login');    
    }
}
