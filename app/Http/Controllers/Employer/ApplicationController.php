<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the job applications.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Get all jobs posted by this employer
        $jobIds = Job::where('id_admin', $user->id)->pluck('id_job');
        
        // Query applications for these jobs
        $query = JobApplication::whereIn('job_id', $jobIds)
                              ->with(['user', 'job']);
        
        // Apply filters if provided
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        if ($request->has('job_id') && $request->job_id) {
            $query->where('job_id', $request->job_id);
        }
        
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->whereHas('user', function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }
        
        $applications = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Get list of jobs for filter dropdown
        $jobs = Job::where('id_admin', $user->id)
                  ->orderBy('title')
                  ->get(['id_job', 'title']);
        
        return view('employer.applications.index', compact('applications', 'jobs'));
    }
    
    /**
     * Display the specified job application.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        
        // Get all jobs posted by this employer
        $jobIds = Job::where('id_admin', $user->id)->pluck('id_job');
        
        // Find the application and ensure it belongs to one of this employer's jobs
        $application = JobApplication::whereIn('job_id', $jobIds)
                                    ->where('id', $id)
                                    ->with(['user', 'job'])
                                    ->firstOrFail();
        
        return view('employer.applications.show', compact('application'));
    }
    
    /**
     * Update the status of a job application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,reviewing,shortlisted,accepted,rejected',
        ]);
        
        $user = Auth::user();
        $jobIds = Job::where('id_admin', $user->id)->pluck('id_job');
        $application = JobApplication::whereIn('job_id', $jobIds)
                                ->where('id', $id)
                                ->firstOrFail();
        
        // Get the old status to check if it's changed
        $oldStatus = $application->status;
        $newStatus = $request->status;
        
        $application->status = $newStatus;
        $application->status_updated_at = now();
        $application->save();
        
        // Create notification for the jobseeker if status has changed
        if ($oldStatus !== $newStatus) {
            $job = $application->job;
            $statusLabels = [
                'pending' => 'Pending',
                'reviewing' => 'Under Review',
                'shortlisted' => 'Shortlisted',
                'accepted' => 'Accepted',
                'rejected' => 'Rejected'
            ];
            
            // Create notification
            \App\Models\Notification::create([
                'user_id' => $application->user_id,
                'job_application_id' => $application->id,
                'type' => 'status_update',
                'title' => 'Application Status Updated',
                'message' => "Your application for {$job->title} at {$job->company} has been updated to '{$statusLabels[$newStatus]}'.",
                'read' => false
            ]);
        }
        
        return redirect()->route('employer.applications.show', $id)
            ->with('success', 'Application status updated successfully.');
    }
    
    /**
     * Download the resume for a job application.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadResume($id)
    {
        $user = Auth::user();
        
        // Get all jobs posted by this employer
        $jobIds = Job::where('id_admin', $user->id)->pluck('id_job');
        
        // Find the application and ensure it belongs to one of this employer's jobs
        $application = JobApplication::whereIn('job_id', $jobIds)
                                    ->where('id', $id)
                                    ->firstOrFail();
        
        if (!$application->resume_path) {
            return redirect()->back()->with('error', 'No resume found for this application.');
        }
        
        return Storage::download('public/' . $application->resume_path);
    }
}
