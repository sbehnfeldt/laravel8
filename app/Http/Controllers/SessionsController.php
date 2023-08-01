<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        // validate the request
        $attributes = request()->validate([
            'email'    => ['required', 'email'],
            'password' => ['required']
        ]);

        // attempt to authenticate and log in the user
        // based on the provided credentials
        if (!auth()->attempt($attributes)) {
            // Authentication failed: 2 ways to return
//        return back()->withErrors(['email' => 'Could not verify the credentials']);   // $errors
            throw ValidationException::withMessages([
                'email' => 'Could not verify the credentials'
            ]);
        }

        session()->regenerate();   // guard against session fixation attack

        // redirect with a success flash message
        return redirect('/')->with('success', 'Welcome Back');
    }


    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Logged out');
    }
}
