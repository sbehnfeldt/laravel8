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
//        if ($filters['search'] ?? null) {
//            $query->where('title', 'like', '%'.request('search').'%')
//                ->orWhere('body', 'like', '%'.request('search').'%');
//        }
        $query->when($filters['search'] ?? false, fn($query, $search) => $query
            ->where('title', 'like', '%'.$search.'%')
            ->orWhere('body', 'like', '%'.$search.'%'));
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
