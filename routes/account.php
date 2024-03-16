<?php

use App\Http\Controllers\Account\LoginController;
use App\Http\Controllers\Account\RegisterController;
use App\Http\Controllers\Account\PostController;
use App\Http\Controllers\Account\HomeController;
use App\Http\Controllers\Account\SettingController;
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

Route::prefix('account')->middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('account.login');
    Route::post('/login', [LoginController::class, 'store'])->name('account.login.store');

    Route::get('/register', [RegisterController::class, 'index'])->name('account.register');
    Route::post('/register', [RegisterController::class, 'store'])->name('account.register.store');
});

Route::prefix('account')->middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('account.home');
    Route::get('/logout', [LoginController::class, 'logout'])->name('account.login.out');
    Route::get('/posts', [PostController::class, 'index'])->name('account.posts');
    Route::get('/post/{post?}', [PostController::class, 'form'])->name('account.post.form');
    Route::get('/settings/{user}', [SettingController::class, 'edit'])->name('account.settings.edit');

    Route::post('/post', [PostController::class, 'store'])->name('account.post.store');
    Route::post('/post/{post}', [PostController::class, 'update'])->name('account.post.update');
    Route::delete('/post/delete/{post?}', [PostController::class, 'delete'])->name('account.post.delete');
    Route::post('/settings/{user}', [SettingController::class, 'update'])->name('account.settings.update');
});
