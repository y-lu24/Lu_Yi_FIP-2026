<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Return a list of all consultations for the admin panel.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $consultations = Consultation::with('artist')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'data' => $consultations
        ]);
    }

    /**
     * Update the status of a consultation booking.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $consultation = Consultation::find($id);

        if (!$consultation) {
            return response()->json([
                'message' => 'Consultation not found'
            ], 404);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed',
        ]);

        $consultation->update($validated);

        return response()->json([
            'message' => 'Consultation updated successfully',
            'data'    => $consultation
        ]);
    }
}