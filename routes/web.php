<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth',])->group(function(){
    Route::view('home', 'home');
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('posts', PostController::class);
    Route::get('trashed-posts', [PostController::class, 'trashed'])->name('trashed-post');
    Route::put('restore-posts/{post}', [PostController::class , 'restore'])->name('restore-posts');
    Route::get('user/my-account', [UserController::class, 'profile'])->name('user.profile');
    Route::post('user/my-account/upload', [UserController::class, 'uploadAvatar'])->name('user.upload');

    Route::prefix('admin')->middleware(['admin'])->group(function (){
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::post('users/{user}/make-admin', [UserController::class, 'makeAdmin'])->name('user.make-admin');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    });
});



