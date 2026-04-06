<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'bio' => $this->faker->paragraph(),
            'profile_image_url' => $this->faker->imageUrl(400, 400, 'people'),
            'specialty_styles' => $this->faker->randomElement([
                'Chinese Traditional',
                'Fine Line Minimalist',
                'Dotwork',
                'Black and Grey',
                'American Traditional',
            ]),
            'instagram_handle' => '@' . $this->faker->userName(),
            'is_active' => true,
        ];
    }
}