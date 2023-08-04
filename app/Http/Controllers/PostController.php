<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


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

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => ['required', 'image'],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
        $attributes[ 'author_id' ] = auth()->id();
        $attributes[ 'thumbnail'] = request()->file( 'thumbnail' )->store( 'thumbnails');
        $attributes[ 'slug' ] = Str::slug( $attributes[ 'title' ]);

        $post = Post::create($attributes);
        return redirect('/posts/' . $post->slug);
    }
}
