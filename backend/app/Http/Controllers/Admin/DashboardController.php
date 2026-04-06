<?php

namespace App\Http\Controllers\Admin;

// Import the classes we need
use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\ContactMessage;
use App\Models\Consultation;
use App\Models\PortfolioImage;

class DashboardController extends Controller
{
    /**
     * Return dashboard overview data including recent messages and booking stats.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $recentMessages = ContactMessage::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $totalArtists = Artist::where('is_active', true)->count(); // Count all active artists.
        $totalPortfolio = PortfolioImage::count(); // Count total portfolio images.
        $totalConsultations = Consultation::count(); // Count total consultations.
        $pendingConsultations = Consultation::where('status', 'pending')->count(); // Count consultations that are still pending.

        // Return all the stats as a JSON response to the frontend.
        return response()->json([
            'data' => [
                'recent_messages'      => $recentMessages,
                'total_artists'        => $totalArtists,
                'total_portfolio'      => $totalPortfolio,
                'total_consultations'  => $totalConsultations,
                'pending_consultations' => $pendingConsultations,
            ]
        ]);
    }
}