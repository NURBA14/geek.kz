<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $title = $this->faker->words(2, true),
            "slug" => $title,
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
