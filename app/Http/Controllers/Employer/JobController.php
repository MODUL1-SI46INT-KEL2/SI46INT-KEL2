<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\JobApplication;

class JobController extends Controller
{
    /**
     * Display a listing of the employer's jobs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Job::where('id_admin', $user->id);
        
        // Apply filters if provided
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('company', 'like', '%' . $request->search . '%');
            });
        }
        
        $jobs = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Get application counts for each job
        foreach ($jobs as $job) {
            $job->application_count = JobApplication::where('job_id', $job->id_job)->count();
        }
        
        return view('employer.jobs.index', compact('jobs'));
    }
    
    /**
     * Show the form for creating a new job.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employer.jobs.create');
    }
    
    /**
     * Store a newly created job in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:225',
            'description' => 'required|string',
            'category' => 'required|string|max:225',
            'location' => 'required|string|max:225',
            'salary' => 'required|numeric|min:0',
            'job_type' => 'required|string|max:225',
            'position_type' => 'required|string|max:225',
            'status' => 'required|in:active,draft,closed',
        ]);
        
        $user = Auth::user();
        $companyProfile = $user->companyProfile;
        
        $job = new Job();
        $job->id_admin = $user->id;
        $job->title = $request->title;
        $job->company = $companyProfile ? $companyProfile->name : $user->name;
        $job->description = $request->description;
        $job->category = $request->category;
        $job->location = $request->location;
        $job->salary = $request->salary;
        $job->job_type = $request->job_type;
        $job->position_type = $request->position_type;
        $job->status = $request->status;
        $job->posting_date = now();
        $job->save();
        
        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job posted successfully.');
    }
    
    /**
     * Display the specified job.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $job = Job::where('id_job', $id)
                  ->where('id_admin', $user->id)
                  ->firstOrFail();
        
        $applications = JobApplication::where('job_id', $job->id_job)
                                     ->with('user')
                                     ->orderBy('created_at', 'desc')
                                     ->get();
        
        return view('employer.jobs.show', compact('job', 'applications'));
    }
    
    /**
     * Show the form for editing the specified job.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $job = Job::where('id_job', $id)
                  ->where('id_admin', $user->id)
                  ->firstOrFail();
        
        return view('employer.jobs.edit', compact('job'));
    }
    
    /**
     * Update the specified job in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:225',
            'description' => 'required|string',
            'category' => 'required|string|max:225',
            'location' => 'required|string|max:225',
            'salary' => 'required|numeric|min:0',
            'job_type' => 'required|string|max:225',
            'position_type' => 'required|string|max:225',
            'status' => 'required|in:active,draft,closed',
        ]);
        
        $user = Auth::user();
        $job = Job::where('id_job', $id)
                  ->where('id_admin', $user->id)
                  ->firstOrFail();
        
        $job->title = $request->title;
        $job->description = $request->description;
        $job->category = $request->category;
        $job->location = $request->location;
        $job->salary = $request->salary;
        $job->job_type = $request->job_type;
        $job->position_type = $request->position_type;
        $job->status = $request->status;
        $job->save();
        
        return redirect()->route('employer.jobs.edit', $job->id_job)
            ->with('success', 'Job updated successfully.');
    }
    
    /**
     * Remove the specified job from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $job = Job::where('id_job', $id)
                  ->where('id_admin', $user->id)
                  ->firstOrFail();
        
        $job->delete();
        
        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job deleted successfully.');
    }
}
