<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\SavedJob;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    /**
     * Display a listing of jobs for job seekers with search and filter capabilities.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Show all jobs regardless of status for now
        $query = Job::query();
        
        // Debug: Log the SQL query
        \Log::info('Job query: ' . $query->toSql());
        
        // Search by keyword (title, company, description)
        if ($request->has('keyword') && !empty($request->keyword)) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('company', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }
        
        // Filter by job type
        if ($request->has('job_type') && !empty($request->job_type)) {
            $query->whereIn('job_type', $request->job_type);
        }
        
        // Filter by position type
        if ($request->has('position_type') && !empty($request->position_type)) {
            $query->whereIn('position_type', $request->position_type);
        }
        
        // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->whereIn('category', $request->category);
        }
        
        // Filter by location
        if ($request->has('location') && !empty($request->location)) {
            $query->where('location', 'like', "%{$request->location}%");
        }
        
        // Filter by experience level (if column exists)
        if ($request->has('experience_level') && !empty($request->experience_level)) {
            // Check if the column exists before filtering
            if (Schema::hasColumn('jobs', 'experience_level')) {
                $query->whereIn('experience_level', $request->experience_level);
            }
        }
        
        // Filter by job function (if column exists)
        if ($request->has('job_function') && !empty($request->job_function)) {
            // Check if the column exists before filtering
            if (Schema::hasColumn('jobs', 'job_function')) {
                $query->whereIn('job_function', $request->job_function);
            }
        }
        
        // Filter by industry - commented out until industry column is added
        // if ($request->has('industry') && !empty($request->industry)) {
        //     $query->whereIn('industry', $request->industry);
        // }
        
        // Filter by date posted
        if ($request->has('date_posted') && !empty($request->date_posted)) {
            $days = (int) $request->date_posted;
            $query->where('posting_date', '>=', now()->subDays($days));
        }
        
        // Sort results
        $sortBy = $request->sort_by ?? 'posting_date';
        $sortOrder = $request->sort_order ?? 'desc';
        $query->orderBy($sortBy, $sortOrder);
        
        $jobs = $query->paginate(12)->withQueryString();
        
        // Get saved job IDs for the current user
        $savedJobIds = [];
        if (Auth::check()) {
            $savedJobIds = SavedJob::where('user_id', Auth::id())
                ->pluck('job_id')
                ->toArray();
        }
        
        // Get company profiles to access logos
        $companyProfiles = CompanyProfile::all()->keyBy('id');
        
        // Get the users who posted these jobs to access their company profiles
        $jobPosters = [];
        if ($jobs->count() > 0) {
            $jobPosters = \App\Models\User::whereIn('id', $jobs->pluck('id_admin'))
                ->get()
                ->keyBy('id');
        }
        
        // Debug: Log the job count
        \Log::info('Job count: ' . $jobs->count());
        if ($jobs->count() > 0) {
            \Log::info('First job: ' . json_encode($jobs->first()->toArray()));
        }
        
        return view('search-jobs', compact('jobs', 'savedJobIds', 'companyProfiles', 'jobPosters'));
    }
    
    /**
     * Display the specified job.
     *
     * @param  int  $job_id
     * @return \Illuminate\Http\Response
     */
    public function show($job_id)
    {
        $job = Job::where('id_job', $job_id)->firstOrFail();
        
        // Check if the job is saved by the current user
        $isSaved = false;
        if (Auth::check()) {
            $isSaved = SavedJob::where('user_id', Auth::id())
                ->where('job_id', $job_id)
                ->exists();
        }
        
        // Get similar jobs - only using job_type and location to avoid industry column issues
        $similarJobs = Job::where('id_job', '!=', $job_id)
            ->where(function($query) use ($job) {
                $query->where('job_type', $job->job_type)
                    ->orWhere('location', 'like', "%{$job->location}%");
            })
            ->where('status', 'active')
            ->limit(3)
            ->get();
        
        // Get all saved job IDs for the current user
        $savedJobIds = [];
        if (Auth::check()) {
            $savedJobIds = SavedJob::where('user_id', Auth::id())
                ->pluck('job_id')
                ->toArray();
        }
        
        // Get company profiles to access logos and company names
        $companyProfiles = CompanyProfile::all()->keyBy('id');
        
        // Get the user who posted this job to access their company profile
        $jobPoster = \App\Models\User::find($job->id_admin);
        
        return view('job-details', compact('job', 'isSaved', 'similarJobs', 'savedJobIds', 'companyProfiles', 'jobPoster'));
    }
    
    /**
     * Get autocomplete suggestions for job search.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        
        if (empty($query)) {
            return response()->json([]);
        }
        
        // Get job titles
        $titles = Job::where('title', 'like', "%{$query}%")
            ->where('status', 'active')
            ->distinct()
            ->limit(5)
            ->pluck('title');
            
        // Get companies
        $companies = Job::where('company', 'like', "%{$query}%")
            ->where('status', 'active')
            ->distinct()
            ->limit(5)
            ->pluck('company');
            
        // Get skills
        $skills = Job::where('skills', 'like', "%{$query}%")
            ->where('status', 'active')
            ->pluck('skills')
            ->map(function($skillSet) use ($query) {
                $skillArray = explode(',', $skillSet);
                return array_filter($skillArray, function($skill) use ($query) {
                    return stripos(trim($skill), $query) !== false;
                });
            })
            ->flatten()
            ->unique()
            ->take(5);
        
        $suggestions = collect()
            ->merge($titles->map(function($item) { return ['type' => 'title', 'value' => $item]; }))
            ->merge($companies->map(function($item) { return ['type' => 'company', 'value' => $item]; }))
            ->merge($skills->map(function($item) { return ['type' => 'skill', 'value' => trim($item)]; }))
            ->take(10);
        
        return response()->json($suggestions);
    }
}
