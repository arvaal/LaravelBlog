<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account\Post;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts[] = array(
            'user_id' => 1,
            'name' => 'Мой первый пост',
            'title' => 'Первый пост моего блога',
            'meta_description' => 'Пост о моем первом блоге',
            'description' => 'Пост моего блога',
            'tags' => 'первый,пост,блог',
            'image' => '',
            'status' => 1,
            'views' => 0,
        );

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
