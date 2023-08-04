<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application as Application2;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    /**
     * @return Application2|Factory|View|Application
     */
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }


    /**
     * @return Application2|Factory|View|Application
     */
    public function create()
    {
        return view('admin.posts.create');
    }


    /**
     * @return Application2|Application|RedirectResponse|Redirector
     */
    public function store(): Application|Redirector|RedirectResponse|Application2
    {
        $attributes = $this->validatePost(new Post());

        $attributes['author_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        $attributes['slug']      = Str::slug($attributes['title']);

        $post = Post::create($attributes);
        return redirect('/posts/'.$post->slug);
    }


    /**
     * @param  Post  $post
     * @return Application2|Factory|View|Application
     */
    public function edit(Post $post): Factory|View|Application|Application2
    {
        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }


    /**
     * @param  Post  $post
     * @return RedirectResponse
     */
    public function update(Post $post): RedirectResponse
    {
        $attributes = $this->validatePost();

        if ($attributes['thumbnail'] ?? false ) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }
        $attributes['slug'] = Str::slug($attributes['title']);

        $post->update($attributes);

        return back()->with('success', 'Post updated!');
    }


    /**
     * @param  Post  $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return back()->with('success', 'Post deleted!');
    }


    /**
     * @param ?Post $post
     * @return array
     */
    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([
            'title'       => 'required',
            'thumbnail'   => $post->exists ? ['image'] : ['required', 'image'],
            'slug'        => Rule::unique('posts', 'slug')->ignore($post),
            'excerpt'     => 'required',
            'body'        => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }
}
