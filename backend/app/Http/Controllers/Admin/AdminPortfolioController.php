<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioImage;
use Illuminate\Http\Request;

class AdminPortfolioController extends Controller
{
    /**
     * Return a list of all portfolio images for the admin panel.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $images = PortfolioImage::with(['artist', 'styles'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'data' => $images
        ]);
    }

    /**
     * Store a new portfolio image record in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'artist_id'       => 'required|integer',
            'image_url'       => 'required|string|max:191',
            'title'           => 'nullable|string|max:191',
            'description'     => 'nullable|string',
            'completion_date' => 'nullable|date',
        ]);

        $image = PortfolioImage::create($validated);

        return response()->json([
            'message' => 'Portfolio image created successfully',
            'data'    => $image
        ], 201);
    }

    /**
     * Update an existing portfolio image record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $image = PortfolioImage::find($id);

        if (!$image) {
            return response()->json([
                'message' => 'Portfolio image not found'
            ], 404);
        }

        $validated = $request->validate([
            'artist_id'       => 'sometimes|integer',
            'image_url'       => 'sometimes|string|max:191',
            'title'           => 'nullable|string|max:191',
            'description'     => 'nullable|string',
            'completion_date' => 'nullable|date',
        ]);

        $image->update($validated);

        return response()->json([
            'message' => 'Portfolio image updated successfully',
            'data'    => $image
        ]);
    }

    /**
     * Delete a portfolio image record from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $image = PortfolioImage::find($id);

        if (!$image) {
            return response()->json([
                'message' => 'Portfolio image not found'
            ], 404);
        }

        $image->delete();

        return response()->json([
            'message' => 'Portfolio image deleted successfully'
        ]);
    }
}