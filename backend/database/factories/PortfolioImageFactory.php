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

        $titles = [
            'Ginkgo Sleeve',
            'Dragon Koi',
            'Lotus Bloom',
            'Crane in Flight',
            'Tiger Spirit',
            'Peony Garden',
        ];

        $images = [
            'images/tattoo1.jpg',
            'images/tattoo2.jpg',
            'images/tattoo3.jpg',
            'images/tattoo4.jpg',
            'images/tattoo5.jpg',
            'images/tattoo6.jpg',
        ];

        return [
            'artist_id' => $artist->id,
            'image_url' => $this->faker->randomElement($images),
            'title' => $this->faker->randomElement($titles),
            'description' => null,
            'completion_date' => $this->faker->date(),
        ];
    }
}