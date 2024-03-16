<?php

use App\Http\Controllers\Blog\HomeController;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Blog\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('blog')->group(function () {
   Route::get('/posts', [PostController::class, 'index'])->name('blog.posts');
   Route::get('/post/{post}', [PostController::class, 'show'])->name('blog.post.show');
   Route::get('/search', [SearchController::class, 'index'])->name('blog.search');

   Route::post('/post/{post}/comment', [PostController::class, 'write_comment'])->name('blog.comment.add');
});
Route::redirect('/home', '/', 301)->name('home.redirect');
