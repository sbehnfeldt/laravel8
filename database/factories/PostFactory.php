<?php

namespace Database\Factories;

use App\Helpers\Utilities;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Hamcrest\Util;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model =  Post::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $title = substr( $this->faker->sentence, 0, -1),   // drop tailing period
            'author_id' => User::factory(),
            'category_id' => Category::factory(),
            'slug' => Utilities::snakify($title),
            'excerpt' => implode( '', array_map( function($el) {
                return '<p>'.$el.'</p>';
            }, $this->faker->paragraphs(rand(1,2)))),
            'body' => implode( '', array_map( function($el) {
                return '<p>'.$el.'</p>';
            }, $this->faker->paragraphs(rand(5,10)))),
        ];
    }

    public function fakeBody()
    {
        $body = '';
        for ( $i = 0; $i < 6; $i++ ) {
            $body .= '<p>' . $this->faker->paragraph . '</p>';
        }
        return $body;
    }
}
