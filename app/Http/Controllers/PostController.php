<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts'      => Post::latest('published_at')
                ->filter(request(['search', 'category', 'author']))
                ->with(['category', 'author'])
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
