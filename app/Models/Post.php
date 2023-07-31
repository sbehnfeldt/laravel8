<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'excerpt', 'body'];


    public function scopeFilter($query, array $filters)   // Post::newQuery()->search()
    {
        // Two ways to filter on the "search" parameter of the query string
//        if ($filters['search'] ?? null) {
//            $query->where('title', 'like', '%'.request('search').'%')
//                ->orWhere('body', 'like', '%'.request('search').'%');
//        }
        $query->when($filters['search'] ?? false, fn($query, $search) => $query
            ->where('title', 'like', '%'.$search.'%')
            ->orWhere('body', 'like', '%'.$search.'%'));

        // Two ways to filter on the "category" parameter of the query string
//        $query->when($filters['category'] ?? false, fn($query, $category) => $query
//            ->whereExists( fn($query) => $query
//            ->from( 'categories')
//                ->whereColumn( 'categories.id', 'posts.category_id')
//                ->where('categories.slug', $category))
        $query->when($filters['category'] ?? false, fn($query, $category) => $query
            ->whereHas( 'category', fn($query) => $query
                ->where('slug', $category)));

        $query->when($filters['author'] ?? false, fn($query, $author) => $query
            ->whereHas( 'author', fn($query) => $query
                ->where('username', $author))
        );
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
