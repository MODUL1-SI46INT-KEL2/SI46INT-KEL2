<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\JobseekerProfile;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of candidates.
     */
    public function index(Request $request)
    {
        // Only allow employers to access this page
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $query = User::where('role', 'jobseeker')
            ->with('jobseekerProfile');

        // Search by name or skills
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('jobseekerProfile', function($query) use ($search) {
                      $query->where('skills', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by skills
        if ($request->has('skills')) {
            $skills = $request->input('skills');
            $query->whereHas('jobseekerProfile', function($query) use ($skills) {
                $query->where('skills', 'like', "%{$skills}%");
            });
        }

        // Filter by experience
        if ($request->has('experience')) {
            $experience = $request->input('experience');
            $query->whereHas('jobseekerProfile', function($query) use ($experience) {
                $query->where('experience', 'like', "%{$experience}%");
            });
        }

        // Filter by education
        if ($request->has('education')) {
            $education = $request->input('education');
            $query->whereHas('jobseekerProfile', function($query) use ($education) {
                $query->where('education', 'like', "%{$education}%");
            });
        }
        
        // Filter by job title
        if ($request->has('job_title')) {
            $jobTitle = $request->input('job_title');
            $query->whereHas('jobseekerProfile', function($query) use ($jobTitle) {
                $query->where('job_title', 'like', "%{$jobTitle}%");
            });
        }
        
        // Filter by location
        if ($request->has('location')) {
            $location = $request->input('location');
            $query->whereHas('jobseekerProfile', function($query) use ($location) {
                $query->where('location', 'like', "%{$location}%");
            });
        }
        
        // Filter by availability
        if ($request->has('available_for_hire')) {
            $query->whereHas('jobseekerProfile', function($query) {
                $query->where('available_for_hire', true);
            });
        }

        // Sort candidates
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        
        $allowedSortFields = ['name', 'created_at'];
        if (!in_array($sortBy, $allowedSortFields)) {
            $sortBy = 'created_at';
        }
        
        $query->orderBy($sortBy, $sortOrder);

        // Paginate results
        $candidates = $query->paginate(10);

        return view('employer.candidates.index', compact('candidates'));
    }

    /**
     * Display the specified candidate.
     */
    public function show($id)
    {
        // Only allow employers to access this page
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $candidate = User::where('role', 'jobseeker')
            ->with('jobseekerProfile')
            ->findOrFail($id);
        
        // Get candidate's applications for jobs posted by this employer
        $applications = $candidate->jobApplications()
            ->whereHas('job', function($query) {
                $query->where('id_admin', auth()->user()->id);
            })
            ->with('job')
            ->get();

        return view('employer.candidates.show', compact('candidate', 'applications'));
    }
}
