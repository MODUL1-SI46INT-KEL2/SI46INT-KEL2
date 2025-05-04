<?php

namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobApplication;
use App\Models\Job;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the user's job applications.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Ensure user is a jobseeker
        if ($user->role !== 'jobseeker') {
            return redirect()->route('dashboard')
                ->with('error', 'Only jobseekers can access this page.');
        }
        
        // Get filter parameters
        $status = $request->input('status');
        $search = $request->input('search');
        
        // Base query
        $query = JobApplication::where('user_id', $user->id)
            ->with(['job', 'job.admin']);
        
        // Apply filters
        if ($status) {
            $query->where('status', $status);
        }
        
        if ($search) {
            $query->whereHas('job', function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%");
            });
        }
        
        // Get applications with pagination
        $applications = $query->latest()->paginate(10);
        
        // Get status counts for filter badges
        $statusCounts = [
            'all' => JobApplication::where('user_id', $user->id)->count(),
            'pending' => JobApplication::where('user_id', $user->id)->where('status', 'pending')->count(),
            'reviewing' => JobApplication::where('user_id', $user->id)->where('status', 'reviewing')->count(),
            'shortlisted' => JobApplication::where('user_id', $user->id)->where('status', 'shortlisted')->count(),
            'rejected' => JobApplication::where('user_id', $user->id)->where('status', 'rejected')->count(),
            'accepted' => JobApplication::where('user_id', $user->id)->where('status', 'accepted')->count(),
        ];
        
        // Get company profiles to access logos and company names
        $companyProfiles = \App\Models\CompanyProfile::all()->keyBy('id');
        
        // Get the users who posted these jobs to access their company profiles
        $jobPosters = [];
        if ($applications->count() > 0) {
            $jobPosters = \App\Models\User::whereIn('id', $applications->pluck('job.id_admin'))
                ->get()
                ->keyBy('id');
        }
        
        return view('jobseeker.applications.index', compact('applications', 'statusCounts', 'status', 'search', 'companyProfiles', 'jobPosters'));
    }
    
    /**
     * Display the specified job application.
     */
    public function show($id)
    {
        $user = Auth::user();
        
        // Ensure user is a jobseeker
        if ($user->role !== 'jobseeker') {
            return redirect()->route('dashboard')
                ->with('error', 'Only jobseekers can access this page.');
        }
        
        // Get the application and ensure it belongs to the user
        $application = JobApplication::where('id', $id)
            ->where('user_id', $user->id)
            ->with(['job', 'job.admin'])
            ->firstOrFail();
        
        // Get application timeline
        $timeline = $this->getApplicationTimeline($application);
        
        // Get company profile for the job poster
        $companyProfiles = \App\Models\CompanyProfile::all()->keyBy('id');
        $jobPoster = \App\Models\User::find($application->job->id_admin);
        
        return view('jobseeker.applications.show', compact('application', 'timeline', 'companyProfiles', 'jobPoster'));
    }
    
    /**
     * Generate application timeline based on status and dates.
     */
    private function getApplicationTimeline($application)
    {
        $timeline = [];
        
        // Application submitted
        $timeline[] = [
            'status' => 'submitted',
            'date' => $application->created_at,
            'title' => 'Application Submitted',
            'description' => 'Submitted successfully',
            'completed' => true,
            'current' => $application->status === 'pending',
        ];
        
        // Application under review
        $timeline[] = [
            'status' => 'reviewing',
            'date' => $application->status_updated_at ?? null,
            'title' => 'Under Review',
            'description' => 'Being reviewed',
            'completed' => in_array($application->status, ['reviewing', 'shortlisted', 'accepted', 'rejected']),
            'current' => $application->status === 'reviewing',
        ];
        
        // Shortlisted
        $timeline[] = [
            'status' => 'shortlisted',
            'date' => $application->status === 'shortlisted' ? $application->status_updated_at : null,
            'title' => 'Shortlisted',
            'description' => 'Selected for consideration',
            'completed' => in_array($application->status, ['shortlisted', 'accepted']),
            'current' => $application->status === 'shortlisted',
        ];
        
        // Final decision
        if ($application->status === 'accepted') {
            $timeline[] = [
                'status' => 'accepted',
                'date' => $application->status_updated_at,
                'title' => 'Accepted',
                'description' => 'Congratulations!',
                'completed' => true,
                'current' => true,
            ];
        } elseif ($application->status === 'rejected') {
            $timeline[] = [
                'status' => 'rejected',
                'date' => $application->status_updated_at,
                'title' => 'Rejected',
                'description' => 'Not selected',
                'completed' => true,
                'current' => true,
            ];
        } else {
            $timeline[] = [
                'status' => 'decision',
                'date' => null,
                'title' => 'Final Decision',
                'description' => 'Awaiting decision',
                'completed' => false,
                'current' => false,
            ];
        }
        
        return $timeline;
    }
    
    /**
     * Withdraw a job application.
     */
    public function withdraw($id)
    {
        $user = Auth::user();
        
        // Ensure user is a jobseeker
        if ($user->role !== 'jobseeker') {
            return redirect()->route('dashboard')
                ->with('error', 'Only jobseekers can access this page.');
        }
        
        // Get the application and ensure it belongs to the user
        $application = JobApplication::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();
        
        // Check if the application can be withdrawn
        if (in_array($application->status, ['accepted', 'rejected'])) {
            return redirect()->route('jobseeker.applications.show', $application->id)
                ->with('error', 'You cannot withdraw an application that has already been processed.');
        }
        
        // Update the application status
        $application->status = 'withdrawn';
        $application->status_updated_at = now();
        $application->save();
        
        return redirect()->route('jobseeker.applications.index')
            ->with('success', 'Your application has been withdrawn successfully.');
    }
}
