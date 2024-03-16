<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Common\Navbar;

class NavigationBarController extends Controller
{
    public static function get()
    {
        $data = array();

        $navigation_bars = Navbar::orderBy('ordering')->get()->where('status', 1);

        foreach ($navigation_bars as $bar) {
            $data['bars'][] = array(
                'name' => $bar['name'],
                'route' => $bar['route']
            );
        }

        return view('common.navigation_bar', $data);
    }
}
