<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application as ApplicationAlias;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(): View|Application|Factory|ApplicationAlias
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name'     => ['required', 'min:8', 'max:255'],
            'username' => ['required', 'min:3', 'max:64'],
            'email'    => ['required', 'max:255', 'email'],
            'password' => ['required', 'min:8', 'max:64']
        ]);
        // If validation fails, Laravel auto redirects to previous page

        // Password is still plain text at this point,
        // but gets inserted into the database encrypted,
        // despite what is shown in https://laracasts.com/series/laravel-8-from-scratch/episodes/46.
        // (This may be due to the "$casts" member of User class?)
        User::create($attributes);

        return redirect( '/' );
    }
}
