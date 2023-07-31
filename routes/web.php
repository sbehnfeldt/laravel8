<?php

use App\Http\Controllers\PostController;
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


//Route::get('/categories', function () {
//    return view('categories', [
//        'categories' => Category::all()->sortBy('name')
//    ]);
//});
//
//Route::get('/categories/{category:slug}', function (Category $category) {
//    return view('posts', [
//        'posts'           => $category->posts,
//        'categories'      => Category::all()->sortBy('name'),
//        'currentCategory' => $category
//    ]);
//})->name('category');

Route::get('/authors/{author:username}', function (User $author) {
    return view('posts', [
        'posts'      => $author->posts
    ]);
});
