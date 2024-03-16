<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Account\User;
use App\Models\Blog\Comment;
use App\Models\Blog\Post;
use App\Models\Common\ImageResize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller {

    public function index(): object {
        $data = array();

        $posts = Post::paginate(10);

        foreach ($posts as $post) {
            $data['posts'][] = array(
                'title' => $post['title'],
                'thumb' => ImageResize::resize($post['image'], $post['created_at'], 300, 169),
                'link' => route('blog.post.show', $post['id'])
            );
        }

        $data['pagination'] = $posts->links();

        return view('blog.posts', $data);
    }

    public function show($id): string {
        $data = array();
        $post = Post::select('*')->where('id', $id)->get()->first();

        $post->views = $post['views'] + 1;
        $post->update();

        if (!empty($post)) {
            $data['success'] = session('success');
            $data['name'] = $post['name'];
            $data['title'] = $post['title'];
            $data['meta_description'] = $post['meta_description'];
            $data['description'] = $post['description'];
            $data['image'] = ImageResize::resize($post['image'], $post['created_at'], 800, 450);

            if (auth()->id()) {
                $data['user'] = User::get('id', auth()->id())->first()->value('name');
            } else {
                $data['user'] = false;
            }

            $data['login'] = route('account.login');
            $data['register'] = route('account.register');

            $data['comments'] = array();

            $comments = Comment::select('*')->where(['post_id' => $id, 'status' => 1])->get();

            foreach ($comments as $comment) {
                $data['comments'][] = array(
                    'user_id' => $comment['user_id'],
                    'user' => User::get('id', $comment['user_id'])->first()->value('name'),
                    'comment' => $comment['comment'],
                    'created_at' => date('H:i d-m-Y', strtotime($comment['created_at'])),
                );
            }

            $data['action'] = route('blog.comment.add', $id);
        }

        return view('blog.post', $data);
    }

    public function write_comment($post_id, Request $request): RedirectResponse {

        $user_id = auth()->id();
        if ($user_id) {
            $validate = $request->validate([
                'comment' => ['min:3', 'max:1024']
            ]);

            if ($validate) {
                $comment = [
                    'user_id' => $user_id,
                    'post_id' => $post_id,
                    'comment' => $request->input('comment'),
                    'status' => 0,
                ];

                Comment::create($comment);

                return redirect()->route('blog.post.show', $post_id)->with('success', 'Комментарий отправлен на модерацию.');
            } else {
                return back()->withInput();
            }
        } else {
            return redirect()->route('account.login');
        }
    }
}
