<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the user's job applications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = JobApplication::where('user_id', Auth::id())
            ->with('job')
            ->latest()
            ->get();
        
        // Get company profiles to access logos and company names
        $companyProfiles = \App\Models\CompanyProfile::all()->keyBy('id');
        
        // Get the users who posted these jobs to access their company profiles
        $jobPosters = [];
        if ($applications->count() > 0) {
            $jobPosters = \App\Models\User::whereIn('id', $applications->pluck('job.id_admin'))
                ->get()
                ->keyBy('id');
        }
            
        return view('application-status', compact('applications', 'companyProfiles', 'jobPosters'));
    }
    
    /**
     * Apply for a job using Easy Apply.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function easyApply($id)
    {
        $job = Job::findOrFail($id);
        
        // Check if the user has already applied for this job
        $existingApplication = JobApplication::where('user_id', Auth::id())
            ->where('job_id', $id)
            ->first();
            
        if ($existingApplication) {
            return redirect()->route('jobseeker.applications.show', $existingApplication->id)
                ->with('warning', 'You have already applied for this job.');
        }
        
        // Create a new application
        $application = new JobApplication();
        $application->user_id = Auth::id();
        $application->job_id = $id;
        $application->status = 'pending';
        $application->status_updated_at = now(); // Set the status updated timestamp
        $application->save();
        
        // Redirect to the jobseeker application details page
        return redirect()->route('jobseeker.applications.show', $application->id)
            ->with('success', 'Your application has been submitted successfully!');
    }
}
