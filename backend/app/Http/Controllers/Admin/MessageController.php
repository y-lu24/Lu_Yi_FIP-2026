<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Return a list of all contact messages for the admin panel.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'data' => $messages
        ]);
    }

    /**
     * Update the status of a contact message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $message = ContactMessage::find($id);

        if (!$message) {
            return response()->json([
                'message' => 'Message not found'
            ], 404);
        }

        $validated = $request->validate([
            'status' => 'required|in:new,read,responded',
        ]);

        $message->update($validated);

        return response()->json([
            'message' => 'Message status updated successfully',
            'data'    => $message
        ]);
    }
}