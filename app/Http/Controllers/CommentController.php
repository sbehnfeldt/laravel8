<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Post $post)
    {
        // add a comment to the given post
        request()->validate([
            'body' => 'required'
        ]);

        // auth()->id()
        // auth()->user()->id
        // request()->user()->id
        $post->comments()->create([
            'author_id' => auth()->id(),
            'body'    => request('body')
        ]);

        return back();
    }
}
