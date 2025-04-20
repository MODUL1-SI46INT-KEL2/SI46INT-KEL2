<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobTracking;
use Illuminate\Support\Facades\Auth;


class JobTrackingController extends Controller
{
   
    // Show tracking info (for job seeker)
    public function index()
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please log in first');
    }
    
    $userId = Auth::id();
    $trackings = JobTracking::where('user_id', $userId)->get();
    
    return view('tracking.index', compact('trackings'));
}

    // Update tracking info (for employer)
    public function update(Request $request, $id)
    {
        $tracking = JobTracking::findOrFail($id);
        $tracking->status = $request->status;
        $tracking->save();

        return redirect()->back()->with('success', 'Job status updated!');
    }
}
