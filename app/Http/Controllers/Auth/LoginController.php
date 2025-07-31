<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
       public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Log pour debug
            \Log::info('User logged in successfully', ['user_id' => Auth::id()]);
            
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Ces identifiants ne correspondent pas.',
        ])->withInput($request->only('email'));
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
