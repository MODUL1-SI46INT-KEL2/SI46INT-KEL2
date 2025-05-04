<?php

namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\JobseekerProfile;

class ProfileController extends Controller
{
    /**
     * Display the jobseeker profile edit form.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        
        // Ensure user is a jobseeker
        if ($user->role !== 'jobseeker') {
            return redirect()->route('dashboard')
                ->with('error', 'Only jobseekers can access this page.');
        }
        
        // Get or create jobseeker profile
        $profile = $user->jobseekerProfile ?? new JobseekerProfile(['user_id' => $user->id]);
        
        return view('jobseeker.profile.edit', compact('user', 'profile'));
    }
    
    /**
     * Update the jobseeker profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Ensure user is a jobseeker
        if ($user->role !== 'jobseeker') {
            return redirect()->route('dashboard')
                ->with('error', 'Only jobseekers can access this page.');
        }
        
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'portfolio' => 'nullable|file|max:10240', // Allow any file type for portfolio, max 10MB
            'portfolio_description' => 'nullable|string|max:500',
            'skills' => 'nullable|string',
            'experience' => 'nullable|string',
            'education' => 'nullable|string',
            'job_title' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'available_for_hire' => 'nullable|boolean',
        ]);
        
        // Update user basic info
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();
        
        // Get or create jobseeker profile
        $profile = $user->jobseekerProfile ?? new JobseekerProfile(['user_id' => $user->id]);
        
        // Handle resume upload
        if ($request->hasFile('resume')) {
            // Delete old resume if exists
            if ($profile->resume_path) {
                Storage::delete('public/' . $profile->resume_path);
            }
            
            $resumePath = $request->file('resume')->store('uploads/resumes', 'public');
            $profile->resume_path = $resumePath;
        }
        
        // Handle portfolio upload
        if ($request->hasFile('portfolio')) {
            // Delete old portfolio if exists
            if ($profile->portfolio_path) {
                Storage::delete('public/' . $profile->portfolio_path);
            }
            
            $portfolioPath = $request->file('portfolio')->store('uploads/portfolios', 'public');
            $profile->portfolio_path = $portfolioPath;
        }
        
        // Update all profile fields
        $profile->portfolio_description = $request->portfolio_description;
        $profile->skills = $request->skills;
        $profile->experience = $request->experience;
        $profile->education = $request->education;
        $profile->job_title = $request->job_title;
        $profile->location = $request->location;
        $profile->website = $request->website;
        $profile->linkedin = $request->linkedin;
        $profile->github = $request->github;
        $profile->bio = $request->bio;
        $profile->available_for_hire = $request->has('available_for_hire');
        
        // Save the profile
        $user->jobseekerProfile()->save($profile);
        
        return redirect()->route('jobseeker.profile.edit')
            ->with('success', 'Profile updated successfully.');
    }
}
