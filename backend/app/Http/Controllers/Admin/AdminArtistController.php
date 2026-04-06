<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;

class AdminArtistController extends Controller
{
    /**
     * Return a list of all artists for the admin panel.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $artists = Artist::all();

        return response()->json([
            'data' => $artists
        ]);
    }

    /**
     * Store a new artist record in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:191',
            'bio'               => 'required|string',
            'profile_image_url' => 'nullable|string|max:191',
            'specialty_styles'  => 'nullable|string|max:191',
            'instagram_handle'  => 'nullable|string|max:191',
            'is_active'         => 'boolean',
        ]);

        $artist = Artist::create($validated);

        return response()->json([
            'message' => 'Artist created successfully',
            'data'    => $artist
        ], 201);
    }

    /**
     * Update an existing artist record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $artist = Artist::find($id);

        if (!$artist) {
            return response()->json([
                'message' => 'Artist not found'
            ], 404);
        }

        $validated = $request->validate([
            'name'              => 'sometimes|string|max:191',
            'bio'               => 'sometimes|string',
            'profile_image_url' => 'nullable|string|max:191',
            'specialty_styles'  => 'nullable|string|max:191',
            'instagram_handle'  => 'nullable|string|max:191',
            'is_active'         => 'boolean',
        ]);

        $artist->update($validated);

        return response()->json([
            'message' => 'Artist updated successfully',
            'data'    => $artist
        ]);
    }

    /**
     * Deactivate an artist by setting is_active to false.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $artist = Artist::find($id);

        if (!$artist) {
            return response()->json([
                'message' => 'Artist not found'
            ], 404);
        }

        $artist->update(['is_active' => false]);

        return response()->json([
            'message' => 'Artist deactivated successfully'
        ]);
    }
}