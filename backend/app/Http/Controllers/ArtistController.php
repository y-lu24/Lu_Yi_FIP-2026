<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Return a list of all active artists.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $artists = Artist::where('is_active', true)->get();

        return response()->json([
            'data' => $artists
        ]);
    }

    /**
     * Return a single artist with their portfolio images.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $artist = Artist::with('portfolioImages')->find($id);

        if (!$artist) {
            return response()->json([
                'message' => 'Artist not found'
            ], 404);
        }

        return response()->json([
            'data' => $artist
        ]);
    }
}