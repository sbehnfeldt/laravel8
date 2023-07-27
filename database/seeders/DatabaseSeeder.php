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
        User::truncate();
        Category::truncate();
        Post::truncate();
        $user = User::factory()->create();

        $personal = Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);
        $family = Category::create([
            'name' => 'Family',
            'slug' => 'family'
        ]);
        $hobbies = Category::create([
            'name' => 'Hobbies',
            'slug' => 'hobbies'
        ]);

        Post::create([
            'title' => 'My Family Post',
            'category_id' => $family->id,
            'author_id' => $user->id,
            'slug' => 'my-family-post',
            'excerpt' => 'Lorem ipsum dolor sit amet, dolore iusto labore voluptas?',
            'body' => '<p>Lorem ipsum dolor sit amet, dolore iusto labore voluptas? Earum fuga illo obcaecati quis sunt suscipit? Culpa doloremque nisi placeat possimus quam repellendus! Dolor, quibusdam, sit!</p>'
        ]);
        Post::create([
            'title' => 'My Personal Post',
            'category_id' => $personal->id,
            'author_id' => $user->id,
            'slug' => 'my-personal-post',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, corporis!',
            'body' => '<p>Lorem ipsum dolor sit amet, adipisci enim est ipsam itaque. Doloremque enim excepturi facere magnam, modi necessitatibus numquam odit officia pariatur quaerat sequi soluta tempore, ut vel?</p>'
        ]);
        Post::create([
            'title' => 'My Hobbies Post',
            'category_id' => $hobbies->id,
            'author_id' => $user->id,
            'slug' => 'my-hobbies-post',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad adipisci alias assumenda at aut cum delectus dicta eaque, iure laborum mollitia quasi quibusdam reprehenderit, totam ullam veniam vero voluptate.</p>'
        ]);
    }
}

