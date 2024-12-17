<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;


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

Route::get('/', function () {
    return redirect('/home');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/new-post', [App\Http\Controllers\HomeController::class, 'newPost'])->name('new.post');
Route::get('/fetch-posts', [App\Http\Controllers\HomeController::class, 'fetchPosts'])->name('fetch.posts');
Route::get('/delete-post/{id}', [App\Http\Controllers\HomeController::class, 'deletePost'])->name('delete.post');
Route::get('/fetch-posts', [App\Http\Controllers\HomeController::class, 'fetchPosts'])->name('fetch.posts');
Route::get('/edit-post/{id}', [App\Http\Controllers\HomeController::class, 'editPost'])->name('edit.post');
Route::post('/update-post/{id}', [App\Http\Controllers\HomeController::class, 'updatePost'])->name('update.post');
Route::post('like-post', [App\Http\Controllers\HomeController::class, 'likePost'])->name('like.post');
Route::post('add-comment', [App\Http\Controllers\HomeController::class, 'addComment']);
Route::post('add-reply', [App\Http\Controllers\HomeController::class, 'addReply']);
Route::get('fetch-comments/{postId}', [App\Http\Controllers\HomeController::class, 'fetchComments']);
Route::get('fetch-replies/{commentId}', [App\Http\Controllers\HomeController::class, 'fetchReplies']);








