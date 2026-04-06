<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsultationFactory extends Factory
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
            'user_id' => null,
            'artist_preference_id' => $artist->id,
            'tattoo_description' => $this->faker->paragraph(),
            'placement' => $this->faker->randomElement(['arm', 'leg', 'back', 'chest', 'neck', 'wrist']),
            'size_estimate' => $this->faker->randomElement(['small', 'medium', 'large']),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'completed']),
        ];
    }
}