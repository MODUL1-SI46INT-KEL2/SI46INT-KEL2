<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedJobController extends Controller
{
    /**
     * Display a listing of the saved jobs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $savedJobs = SavedJob::where('user_id', Auth::id())
            ->with('job')
            ->latest()
            ->paginate(9);
        
        return view('saved-jobs', ['savedJobs' => $savedJobs]);
    }

    /**
     * Save a job to the user's saved jobs list.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request, $job_id)
    {
        // Validate the job exists
        if (!Job::where('id_job', $job_id)->exists()) {
            return response()->json([
                'message' => 'Job not found',
                'saved' => false
            ], 404);
        }

        // Check if job is already saved
        $existingSave = SavedJob::where('user_id', Auth::id())
            ->where('job_id', $job_id)
            ->first();
        
        if ($existingSave) {
            return response()->json([
                'message' => 'Job already saved',
                'saved' => true
            ]);
        }

        // Save the job
        SavedJob::create([
            'user_id' => Auth::id(),
            'job_id' => $job_id,
        ]);

        return response()->json([
            'message' => 'Job saved successfully',
            'saved' => true
        ]);
    }

    /**
     * Remove a job from the user's saved jobs list.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request, $job_id)
    {
        // Validate the job exists
        if (!Job::where('id_job', $job_id)->exists()) {
            return response()->json([
                'message' => 'Job not found',
                'saved' => false
            ], 404);
        }

        // Find and delete the saved job
        $savedJob = SavedJob::where('user_id', Auth::id())
            ->where('job_id', $job_id)
            ->first();
        
        if ($savedJob) {
            $savedJob->delete();
            
            return response()->json([
                'message' => 'Job removed from saved list',
                'saved' => false
            ]);
        }

        return response()->json([
            'message' => 'Job was not in saved list',
            'saved' => false
        ]);
    }

    /**
     * Check if a job is saved by the current user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $job_id
     * @return \Illuminate\Http\Response
     */
    public function checkSaved(Request $request, $job_id)
    {
        // Validate the job exists
        if (!Job::where('id_job', $job_id)->exists()) {
            return response()->json([
                'message' => 'Job not found',
                'saved' => false
            ], 404);
        }
        
        $isSaved = SavedJob::where('user_id', Auth::id())
            ->where('job_id', $job_id)
            ->exists();
        
        return response()->json([
            'saved' => $isSaved
        ]);
    }
}
