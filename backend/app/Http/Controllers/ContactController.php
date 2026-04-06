<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store a new contact message from the form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:191',
            'email'   => 'required|email|max:191',
            'phone'   => 'nullable|string|max:191',
            'message' => 'required|string',
        ]);

        $contactMessage = ContactMessage::create($validated);

        return response()->json([
            'message' => 'Your message has been received. We will be in touch soon!',
            'data'    => $contactMessage
        ], 201);
    }
}