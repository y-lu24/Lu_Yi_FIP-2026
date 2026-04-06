<?php

namespace App\Http\Controllers;

use App\Models\PortfolioImage;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Return a list of the most recent portfolio images with artist and styles.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $images = PortfolioImage::with(['artist', 'styles'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return response()->json([
            'data' => $images
        ]);
    }

    /**
     * Return a single portfolio image with artist and styles.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $image = PortfolioImage::with(['artist', 'styles'])->find($id);

        if (!$image) {
            return response()->json([
                'message' => 'Portfolio image not found'
            ], 404);
        }

        return response()->json([
            'data' => $image
        ]);
    }
}