<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
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

Route::prefix('admin')->middleware(['auth', 'is.admin'])->group(function () {
    Route::redirect('/', 'admin/home');
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
//    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.login.out');
//    Route::get('/posts', [PostController::class, 'index'])->name('account.posts');
//    Route::get('/post/{post?}', [PostController::class, 'form'])->name('account.post.form');
//    Route::get('/settings/{user}', [SettingController::class, 'edit'])->name('account.settings.edit');
//
//    Route::post('/post', [PostController::class, 'store'])->name('account.post.store');
//    Route::post('/post/{post}', [PostController::class, 'update'])->name('account.post.update');
//    Route::delete('/post/delete/{post?}', [PostController::class, 'delete'])->name('account.post.delete');
//    Route::post('/settings/{user}', [SettingController::class, 'update'])->name('account.settings.update');
});
