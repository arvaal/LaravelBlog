<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\User;
use App\Models\Common\ImageResize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('account.settings');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): object
    {

        $data = array();

        $user = User::select('*')->where('id', $id)->first();

        $data['action'] = route('account.settings.update', auth()->id());
        $data['no_image'] = asset('/image/no-image.jpg');

        if (isset($user['avatar'])) {
            $data['avatar'] = ImageResize::resize($user['avatar'], date('Y', strtotime($user['created_at'])), 300, 300);
        } else {
            $data['avatar'] = ImageResize::resize(null, date('Y', strtotime($user['created_at'])), 300, 300);
        }

        if (isset($user['name'])) {
            $data['name'] = $user['name'];
        }


        return view('account.settings', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validate = $request->validate([
            'avatar' => ['image', 'mimes:png,jpg,jpeg', 'max:1024'],
            'name' => ['min:1', 'max:64']
        ]);

        if ($validate) {

            $user = User::select('*')->where(['id' => $id])->first();

            $user->name = $request->input('name');
            $user->avatar = ImageResize::uploadImage($request->file('avatar'), $user['created_at']);
            $user->update();

            return redirect()->route('account.settings.edit', $id)->with('success', 'Вы успешно слхранили настройки');
        } else {
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
