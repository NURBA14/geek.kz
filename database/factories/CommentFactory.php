<?php

namespace Database\Factories;

use App\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{    
    /**
     * @var mixed model
     */
    protected $model = Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "text" => $this->faker->words(3, true),
            "post_id" => $this->faker->numberBetween(1, 100),
            "user_id" => $this->faker->numberBetween(1, 100),
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
