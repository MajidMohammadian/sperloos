<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image = $this->faker->imageUrl();
        $thumb = $this->faker->imageUrl(100,100);

        return [
            'title' => $this->faker->title(),
            'content' => $this->faker->text(),
            'image' => $image,
            'thumbnail' => $thumb,
        ];
    }
}
