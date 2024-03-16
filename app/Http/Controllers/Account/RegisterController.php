<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    private $error;

    public function index(Request $request): object
    {

        $data = array();

        if (empty($request->input('email'))) {
            $data = $request->old();
        }

        return view('account.register', $data);
    }

    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'avatar' => ['image', 'mimes:png,jpg,jpeg', 'max:1024'],
            'email' => ['required', 'unique:users', 'email:rfc,dns', 'max:255'],
            'name' => ['required', 'min:1', 'max:64'],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required_with:password', 'same:password'],
        ]);

        if ($validated) {

            $user = User::factory()->create([
                'avatar' => $request->input('avatar'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);

            Auth::loginUsingId($user->id);

            return redirect()->route('account.home')->with('success', 'Вы успешно зарегистрировались.');
        } else {
            return redirect()->route('account.register')->withInput();
        }
    }
}
