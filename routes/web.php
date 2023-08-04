<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Services\MailchimpNewsletter;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

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

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/posts', function () {
    return redirect('/');
});

Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('post');
Route::post('/posts/{post:slug}/comments', [CommentController::class, 'store'])->name('post')->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::POST('/newsletter', [NewsletterController::class, 'subscribe']);

// Admin
Route::get( '/admin/posts', [ AdminPostController::class, 'index'])->name( 'posts.table')->middleware('admin');
Route::post( '/admin/posts', [ AdminPostController::class, 'store'])->middleware('admin');
Route::get( '/admin/posts/create', [ AdminPostController::class, 'create'])->name( 'create.post')->middleware('admin');
Route::get( '/admin/posts/{post:slug}/edit', [ AdminPostController::class, 'edit'])->name( 'edit.post')->middleware('admin');
Route::patch( '/admin/posts/{post}', [ AdminPostController::class, 'update'])->name( 'update.post')->middleware('admin');
Route::delete( '/admin/posts/{post}', [ AdminPostController::class, 'destroy'])->name( 'delete.post')->middleware('admin');
