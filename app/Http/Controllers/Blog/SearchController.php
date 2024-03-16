<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use App\Models\Common\ImageResize;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $data['word'] = $request->query('word');

        $posts = Post::select('*')->where('title', 'like', '%' . $request->query('word') . '%')->orwhere('description', 'like', '%' . $request->query('word') . '%')->where('status', 1)->paginate(10);

        $data['posts'] = array();

        if ($posts) {
            foreach ($posts as $post) {
                $data['posts'][] = array(
                    'title' => $post['title'],
                    'thumb' => ImageResize::resize($post['image'], $post['created_at'], 300, 169),
                    'link' => route('blog.post.show', $post['id'])
                );
            }

            $data['pagination'] = $posts->links();
        }

        return view('blog.search', $data);
    }
}
