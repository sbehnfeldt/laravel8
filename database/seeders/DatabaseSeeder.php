<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
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
        Post::truncate();
        Category::truncate();
        User::truncate();

        $author = User::factory()->create([
            'name' => 'Bob Buttons'
        ]) ;
        Post::factory(5)->create([
            'author_id' => $author->id
        ]);

        $author = User::factory()->create([
            'name' => 'Betty Bingo'
        ]) ;
        Post::factory(4)->create([
            'author_id' => $author->id
        ]);

        $author = User::factory()->create([
            'name' => 'Benny Banjo'
        ]) ;
        Post::factory(3)->create([
            'author_id' => $author->id
        ]);
    }
}

