<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Category;
use App\Models\User;
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

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/posts', function () {
    return redirect('/');
});

// Find a post by its slug and pass it to a view called "post"
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name( 'post');

Route::get( '/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post( '/register', [RegisterController::class, 'store'])->middleware('guest');
Route::post( '/logout', [SessionsController::class, 'destroy'])->middleware( 'auth');