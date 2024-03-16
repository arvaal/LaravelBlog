<?php

namespace Database\Seeders;

use app\Models\Common\Navbar;
use Illuminate\Database\Seeder;

class NavbarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            [
                'name' => 'Home',
                'route' => 'home',
                'ordering' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Posts',
                'route' => 'blog.posts',
                'ordering' => 2,
                'status' => 1,
            ],
            [
                'name' => 'Login',
                'route' => 'login',
                'ordering' => 3,
                'status' => 1,
            ]
        ];

        foreach ($links as $key => $navbar) {
            Navbar::create($navbar);
        }
    }
}
