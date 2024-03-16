<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\Post;
use App\Models\Common\ImageResize;

class HomeController extends Controller
{
    public function index()
    {

        $user_id = auth()->id();
        $posts = Post::select('*')->where('user_id', $user_id)->limit(10)->get();

        $data['posts'] = array();

        foreach ($posts as $post) {

            $actions = array(
                array(
                    'text' => __('Изменить'),
                    'link' => route('account.post.form', $post['id']),
                    'btn' => 'btn-warning',
                ),
                array(
                    'text' => __('Просмотр'),
                    'link' => route('blog.post.show', $post['id']),
                    'btn' => 'btn-default',
                ),
            );

            $data['posts'][] = array(
                'name' => $post['name'],
                'description' => $post['description'],
                'thumb' => ImageResize::resize($post['image'], $post['created_at'], 100, 56),
                'link' => route('account.post.form', $post['id']),
                'actions' => $actions,
            );
        }

        return view('account.home', $data);
    }
}
