<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $author = User::factory()->create([
            'name' => 'Bob Buttons',
            'username' => 'bbuttons',
            'email' => 'bbuttons@example.com',
        ]) ;
        Post::factory(5)->create([
            'author_id' => $author->id
        ]);

        $author = User::factory()->create([
            'name' => 'Betty Bingo',
            'username' => 'bbingo',
            'email' => 'bbingo@example.com',
        ]) ;
        Post::factory(4)->create([
            'author_id' => $author->id
        ]);

        $author = User::factory()->create([
            'name' => 'Benny Banjo',
            'username' => 'bbanjo',
            'email' => 'bbanjo@example.com',
        ]) ;
        Post::factory(3)->create([
            'author_id' => $author->id
        ]);
    }
}

