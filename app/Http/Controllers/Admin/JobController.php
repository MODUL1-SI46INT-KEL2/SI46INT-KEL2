<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of jobs.
     */
    public function index()
    {
        $jobs = Job::latest()->paginate(10);
        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new job.
     */
    public function create()
    {
        return view('admin.jobs.create');
    }

    /**
     * Show the form for entering job details.
     */
    public function details(Request $request)
    {
        $jobTitle = $request->job_title;
        return view('admin.jobs.details', compact('jobTitle'));
    }

    /**
     * Store a newly created job in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:225',
            'company' => 'required|string|max:225',
            'job_location' => 'required|string|max:225',
            'position_type' => 'required|string|max:225',
            'job_type' => 'required|string|max:225',
            'salary' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $job = new Job();
        $job->title = $request->job_title;
        $job->company = $request->company;
        $job->location = $request->job_location;
        $job->position_type = $request->position_type;
        $job->job_type = $request->job_type;
        $job->salary = $request->salary;
        $job->description = $request->description;
        $job->category = $request->category ?? 'General';
        $job->status = 'active';
        $job->id_admin = Auth::id();
        $job->posting_date = now();
        $job->save();

        return redirect()->route('admin.jobs.index')->with('success', 'Job posted successfully!');
    }

    /**
     * Show the specified job.
     */
    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('admin.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified job.
     */
    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view('admin.jobs.edit', compact('job'));
    }

    /**
     * Update the specified job in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'job_location' => 'required|string|max:255',
            'position_type' => 'required|string|max:255',
            'job_type' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $job = Job::findOrFail($id);
        $job->title = $request->job_title;
        $job->company = $request->company;
        $job->location = $request->job_location;
        $job->position_type = $request->position_type;
        $job->type = $request->job_type;
        $job->salary = $request->salary;
        $job->description = $request->description;
        $job->status = $request->status;
        $job->save();

        return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully!');
    }

    /**
     * Remove the specified job from storage.
     */
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully!');
    }
}
