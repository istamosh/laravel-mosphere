<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // validate the form
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);

        // attempt to log the user in
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // redirect to index
            return redirect()->intended(route('posts.index'));
        } else {
            // login failed
            return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
        }
    }

    public function logout(Request $request)
    {
        // using Auth facade for logout, using web guard
        Auth::guard('web')->logout();

        // destroy the session cookies
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // back to index
        return to_route('posts.index');
    }
}
