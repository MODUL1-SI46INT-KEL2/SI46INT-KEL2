<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display the FAQ index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('faq.index');
    }

    /**
     * Record a helpful vote for a FAQ item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recordVote(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'helpful' => 'required|boolean',
        ]);

        // In a real application, you would save this vote to the database
        // For now, we'll just return a success response
        
        return response()->json([
            'success' => true,
            'message' => 'Vote recorded successfully',
        ]);
    }
}
