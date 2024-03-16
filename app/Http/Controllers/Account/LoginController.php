<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index(Request $request): object
    {

        $data = array();

        if (!empty($request->old())) {
            $data = $request->old();
        }

        return view('account.login', $data);
    }

    public function store(Request $request): RedirectResponse
    {

        if (Auth::attempt($request->only('email', 'password'), $request->has('remember'))) {
            return redirect()->route('account.home');
        } else {

            $validated = $request->validate([
                'email' => ['required', 'exists:users'],
                'password' => ['required', 'current_password']
            ]);

            return back()->withInput();
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('account.login');
    }
}
