<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use App\Models\Common\ImageResize;

class HomeController extends Controller {
    public function index(): object {

        $data = array();

        $posts = Post::get();

        if ($posts) {
            foreach ($posts as $post) {

            $data['posts'][] = array(
                'title' => $post['title'],
                'thumb' => ImageResize::resize($post['image'], $post['created_at'], 300, 169),
                'link' => route('blog.post.show', $post['id']),
            );
        }
        }

        return view('blog.home', $data);
    }
}
