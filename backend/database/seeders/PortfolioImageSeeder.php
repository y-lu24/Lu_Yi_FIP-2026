<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\PortfolioImage;
use Illuminate\Database\Seeder;

class PortfolioImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artists = Artist::all();

        $images = [
            ['image_url' => 'images/tattoo1.jpg', 'title' => 'Ginkgo Sleeve'],
            ['image_url' => 'images/tattoo2.jpg', 'title' => 'Dragon Koi'],
            ['image_url' => 'images/tattoo3.jpg', 'title' => 'Lotus Bloom'],
            ['image_url' => 'images/tattoo4.jpg', 'title' => 'Crane in Flight'],
            ['image_url' => 'images/tattoo5.jpg', 'title' => 'Tiger Spirit'],
            ['image_url' => 'images/tattoo6.jpg', 'title' => 'Peony Garden'],
        ];

        foreach ($images as $image) {
            PortfolioImage::create([
                'artist_id' => $artists->random()->id,
                'image_url' => $image['image_url'],
                'title' => $image['title'],
                'description' => null,
                'completion_date' => now()->subDays(rand(1, 365))->toDateString(),
            ]);
        }
    }
}