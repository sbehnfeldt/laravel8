<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Exception;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    /**
     * @param  Newsletter  $newsletter
     * @return ApplicationAlias|Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function subscribe(Newsletter $newsletter): Application|Redirector|RedirectResponse|ApplicationAlias
    {
        request()->validate(['email' => ['required', 'email']]);
        try {
            $newsletter->subscribe(request('email'));
        } catch (Exception) {
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
        }
        return redirect('/')->with('success', 'You are now signed up for our newsletter!');
    }
}
