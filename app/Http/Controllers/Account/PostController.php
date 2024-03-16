<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\Post;
use App\Models\Common\ImageResize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(): object
    {

        $data = array();

        $user_id = auth()->id();
        $posts = Post::select('*')->where('user_id', $user_id)->get();

        $data['action_delete'] = route('account.post.delete');
        $data['action_add'] = route('account.post.form');

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
                'id' => $post['id'],
                'title' => $post['title'],
                'thumb' => ImageResize::resize($post['image'], $post['created_at'], 100, 56),
                'link' => route('account.post.form', $post['id']),
                'actions' => $actions,
            );
        }

        return view('account.posts', $data);
    }

    public function form($id = 0): object
    {

        $user_id = auth()->id();
        $post = Post::select('*')->where(['id'=>$id, 'user_id' => $user_id])->first();

        $data = array();

        $data['no_image'] = asset('/image/no-image.jpg');

        if (!empty($post)) {

            $data['action'] = route('account.post.update', $id);

                $data['name'] = $post['name'];
                $data['title'] = $post['title'];
                $data['meta_description'] = $post['meta_description'];
                $data['description'] = $post['description'];
                $data['tags'] = $post['tags'];
                $data['image'] = ImageResize::resize($post['image'], $post['created_at'], 300, 169);

        } else {
            $data['action'] = route('account.post.store');
        }

        if (!empty(old())) {
            $data['post'] = old();
        }

        return view('account.post', $data);
    }

    public function store(Request $request): RedirectResponse
    {

        $user_id = auth()->id();

        $validated = $request->validate([
            'name' => ['required', 'min:5', 'max:64'],
            'title' => ['required', 'min:5', 'max:128'],
            'meta_description' => [],
            'description' => ['required', 'min:10', 'max:2048'],
            'tags' => [],
            'image' => ['image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        if ($validated) {

            $post = [
                'user_id' => $user_id,
                'name' => $request->input('name'),
                'title' => $request->input('title'),
                'meta_description' => $request->input('meta_description'),
                'description' => $request->input('description'),
                'tags' => $request->input('tags'),
                'image' => ImageResize::uploadImage($request->file('image'), date('Y')),
            ];

            Post::create($post);

            return redirect()->route('account.posts')->with('success', 'Пост опубликован');
        } else {
            return back()->withInput();
        }
    }

    public function update($id, Request $request): RedirectResponse
    {

        $user_id = auth()->id();

        $validated = $request->validate([
            'name' => ['required', 'min:5', 'max:64'],
            'title' => ['required', 'min:5', 'max:128'],
            'meta_description' => [],
            'description' => ['required', 'min:10', 'max:2048'],
            'tags' => [],
            'image' => ['image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        if ($validated) {

            $post = Post::select('*')->where(['id' => $id, 'user_id' => $user_id]);
            $post->user_id = $user_id;
            $post->name = $request->input('name');
            $post->title = $request->input('title');
            $post->meta_description = $request->input('meta_description');
            $post->description = $request->input('description');
            $post->tags = $request->input('tags');
            $post->image = ImageResize::uploadImage($request->file('image'), $post['created_at']);
            $post->update();

            return redirect()->route('account.posts')->with('success', 'Пост обновлен');
        } else {
            return back()->withInput();
        }
    }

    public function delete(Request $request, Post $post): RedirectResponse
    {
        $user_id = auth()->id();
        $count = $post->select('*')->where(['id' => [$request->input('id')], 'user_id' => $user_id])->count();

        if ($count > 0) {
            $post->destroy($request->input('id'));
            return redirect()->route('account.posts')->with('success', 'Пост удален');
        } else {
            return redirect()->route('account.posts')->with('success', 'У вас такого поста нет');
        }
    }
}
