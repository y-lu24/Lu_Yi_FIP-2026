<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortfolioImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $artist = Artist::inRandomOrder()->first();

        return [
            'artist_id' => $artist->id,
            'image_url' => $this->faker->imageUrl(800, 800, 'abstract'),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'completion_date' => $this->faker->date(),
        ];
    }
}