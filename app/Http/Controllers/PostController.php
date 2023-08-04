<?php

namespace App\Http\Controllers;

use App\Models\Post;


class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts'      => Post::latest('published_at')
                ->filter(request(['search', 'category', 'author']))
                ->with(['category', 'author'])
                ->orderBy( 'created_at', 'desc')
                ->paginate()->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

}
