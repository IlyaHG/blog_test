<?php

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

Route::get('/posts', [\App\Http\Controllers\IndexController::class,'index'])->name('home');

Route::get('/posts', [\App\Http\Controllers\PostController::class,'showPostsForm'])->name('posts');

Route::get('/post/{id}', [\App\Http\Controllers\PostController::class,'showPostForm'])->name('post');

Route::get('/search_comments', [\App\Http\Controllers\PostController::class,'searchComments'])->name('search_comments');

Route::get('/search_posts', [\App\Http\Controllers\PostController::class,'searchPosts'])->name('search_posts');

