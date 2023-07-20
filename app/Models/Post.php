<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post
{
    static public function find($slug)
    {
        if (!file_exists($path = resource_path("/posts/{$slug}.html"))) {
            throw new ModelNotFoundException();
        }

        return cache()->remember("posts.{$slug}", now()->addDays(7), function () use ($path) {
            return file_get_contents($path);
        });
    }

    public static function all()
    {
        return array_map(fn($file) => $file->getContents(), File::files(resource_path("posts")));
    }
}