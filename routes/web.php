<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
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

Route::POST('/newsletter', function () {
    request()->validate(['email' => ['required', 'email']]);


    $mailchimp = new \MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => config('services.mailchimp.prefix'),
    ]);

//    $response = $mailchimp->ping->get();
//    $response = $mailchimp->lists->getAllLists();
//    $response = $mailchimp->lists->getList('5f0f252d9e');
//    $response = $mailchimp->lists->getListMembersInfo('5f0f252d9e');

    try {
        $mailchimp->lists->addListMember(config('services.mailchimp.newsletter'), [
            'email_address' => request('email'),
            'status'        => 'subscribed'  // subscribed, unsubscribed, cleaned, pending, transactional
        ]);
    } catch (Exception $e) {
        throw ValidationException::withMessages([
            'email' => 'This email could not be added to our newsletter list.'
        ]);
    }
    return redirect('/')->with('success', 'You are now signed up for our newsletter!');
});