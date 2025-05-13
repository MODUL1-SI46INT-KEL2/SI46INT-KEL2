<?php

namespace App\Http\Controllers;

use App\Models\CompanyReview;
use App\Models\User;
use App\Models\JobApplication;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Constructor - apply middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a form to submit a new review for a company.
     */
    public function create($employerId)
    {
        // Find the employer and their company profile
        $employer = User::where('id', $employerId)
            ->where('role', 'admin')
            ->firstOrFail();

        // Get company profile
        $company = CompanyProfile::where('user_id', $employerId)->first();
        $companyName = $company ? $company->name : $employer->name;

        // Check if the user has already submitted a review for this company
        $existingReview = CompanyReview::where('user_id', Auth::id())
            ->where('admin_id', $employerId)
            ->first();
            
        if ($existingReview) {
            return redirect()->route('reviews.edit', $existingReview->id)
                ->with('info', 'You have already reviewed this company. You can edit your review below.');
        }
            
        // Check if the user has applied to any jobs from this company
        $hasApplied = JobApplication::whereHas('job', function ($query) use ($employerId) {
                $query->where('id_admin', $employerId);
            })
            ->where('user_id', Auth::id())
            ->exists();
            
        if (!$hasApplied) {
            return redirect()->back()
                ->with('error', 'You can only review companies you have applied to or worked for.');
        }
        
        // Pass company name to view instead of employer details
        return view('reviews.create', compact('employer', 'companyName'));
    }
    
    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'admin_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:10|max:1000',
            'job_title' => 'nullable|string|max:100',
            'employment_period' => 'nullable|string|max:100',
            'anonymous' => 'nullable|boolean',
        ]);
        
        // Ensure the employer exists and is an admin
        $employer = User::where('id', $validated['admin_id'])
            ->where('role', 'admin')
            ->firstOrFail();
            
        // Check if the user has already submitted a review for this employer
        $existingReview = CompanyReview::where('user_id', Auth::id())
            ->where('admin_id', $validated['admin_id'])
            ->first();
            
        if ($existingReview) {
            return redirect()->route('reviews.edit', $existingReview->id)
                ->with('error', 'You have already reviewed this employer. You can edit your review below.');
        }
        
        // Create the new review
        $review = new CompanyReview();
        $review->user_id = Auth::id();
        $review->admin_id = $validated['admin_id'];
        $review->rating = $validated['rating'];
        $review->content = $validated['content'];
        $review->job_title = $validated['job_title'];
        $review->employment_period = $validated['employment_period'];
        $review->anonymous = $request->has('anonymous');
        $review->status = 'pending';
        $review->save();
        
        return redirect()->route('reviews.my')
            ->with('success', 'Your review has been submitted and is pending moderation.');
    }
    
    /**
     * Show the form for editing a review.
     */
    public function edit($id)
    {
        $review = CompanyReview::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
            
        $employer = $review->employer;
        
        // Get company profile instead of personal employer info
        $company = CompanyProfile::where('user_id', $employer->id)->first();
        $companyName = $company ? $company->name : $employer->name;
        
        return view('reviews.edit', compact('review', 'employer', 'companyName'));
    }
    
    /**
     * Update the specified review in storage.
     */
    public function update(Request $request, $id)
    {
        $review = CompanyReview::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
            
        // Only allow updates if the review is pending or rejected
        if (!in_array($review->status, ['pending', 'rejected'])) {
            return redirect()->back()
                ->with('error', 'You cannot edit a review that has already been approved.');
        }
        
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:10|max:1000',
            'job_title' => 'nullable|string|max:100',
            'employment_period' => 'nullable|string|max:100',
            'anonymous' => 'nullable|boolean',
        ]);
        
        $review->rating = $validated['rating'];
        $review->content = $validated['content'];
        $review->job_title = $validated['job_title'];
        $review->employment_period = $validated['employment_period'];
        $review->anonymous = $request->has('anonymous');
        
        // If the review was rejected, set it back to pending for re-moderation
        if ($review->status === 'rejected') {
            $review->status = 'pending';
            $review->rejection_reason = null;
        }
        
        $review->save();
        
        return redirect()->route('reviews.my')
            ->with('success', 'Your review has been updated successfully.');
    }
    
    /**
     * Display a listing of the user's reviews.
     */
    public function myReviews()
    {
        $reviews = CompanyReview::where('user_id', Auth::id())
            ->with('employer')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('reviews.my', compact('reviews'));
    }
    
    /**
     * Display reviews for a specific employer.
     */
    public function employerReviews($employerId)
    {
        // Ensure the employer exists and is an admin
        $employer = User::where('id', $employerId)
            ->where('role', 'admin')
            ->firstOrFail();
            
        $reviews = CompanyReview::where('admin_id', $employerId)
            ->where('status', 'approved')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        $averageRating = CompanyReview::where('admin_id', $employerId)
            ->where('status', 'approved')
            ->avg('rating') ?? 0;
            
        $ratingCounts = CompanyReview::where('admin_id', $employerId)
            ->where('status', 'approved')
            ->selectRaw('rating, count(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();
            
        return view('reviews.employer', compact('employer', 'reviews', 'averageRating', 'ratingCounts'));
    }
}
