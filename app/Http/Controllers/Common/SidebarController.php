<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;

class SidebarController extends Controller
{
    public static function getAsideLeft()
    {
        $data['asides'][] = array(
            'text' => 'Мои посты',
            'link' => route('account.posts'),
        );
        $data['asides'][] = array(
            'text' => 'Настройки',
            'link' => route('account.settings.edit', auth()->id()),
        );
        $data['asides'][] = array(
            'text' => 'Выход',
            'link' => route('account.login.out'),
        );

        return view('common.aside_left', $data);
    }

    public static function getAsideRight()
    {
        $data['asides'][] = array(
            'text' => 'Посты',
            'link' => route('account.posts'),
        );
        $data['asides'][] = array(
            'text' => 'Настройки',
            'link' => route('account.settings.edit', auth()->id()),
        );
        $data['asides'][] = array(
            'text' => 'Выход',
            'link' => route('account.login.out'),
        );

        return view('common.aside_right', $data);
    }
}
