<?php

namespace Database\Factories;

use App\Helpers\Utilities;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Category::class;


    public function definition(): array
    {
        return [
            'name' => $name = ucwords( $this->faker->unique()->word ),
            'slug' => Utilities::snakify($name)
        ];
    }
}
