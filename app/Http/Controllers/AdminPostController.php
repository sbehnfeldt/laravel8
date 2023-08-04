<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {
        $attributes              = request()->validate([
            'title'       => 'required',
            'thumbnail'   => ['required', 'image'],
            'excerpt'     => 'required',
            'body'        => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
        $attributes['author_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        $attributes['slug']      = Str::slug($attributes['title']);

        $post = Post::create($attributes);
        return redirect('/posts/'.$post->slug);
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post)
    {
        $attributes              = request()->validate([
            'title'       => 'required',
            'slug'        => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
            'thumbnail'   => 'image',
            'excerpt'     => 'required',
            'body'        => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        if (isset($attirbutes[ 'thumbnail'])) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }
        $attributes['slug']      = Str::slug($attributes['title']);

        $post->update($attributes);

        return back()->with( 'success', 'Post updated!');
    }

    public function destroy (Post $post)
    {
        $post->delete();

        return back()->with( 'success', 'Post deleted!');
    }
}
