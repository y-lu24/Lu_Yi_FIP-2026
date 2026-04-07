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
            'bio' => $this->faker->randomElement([
                'A dedicated tattoo artist with a passion for culturally rooted custom designs.',
                'Specializing in detailed linework and meaningful compositions.',
                'Bringing Eastern and Western tattoo traditions together in every piece.',
                'Focused on creating one-of-a-kind tattoos that tell a personal story.',
                'Known for clean, precise work across a range of styles.',
                'Committed to crafting tattoos that are as meaningful as they are beautiful.',
            ]),
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