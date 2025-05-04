<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\CompanyReview;

class DashboardController extends Controller
{
    /**
     * Display the employer dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;
        
        // Get counts for dashboard stats
        $activeJobs = Job::where('id_admin', $userId)
                        ->where('status', 'active')
                        ->count();
        
        $totalApplications = JobApplication::whereHas('job', function($query) use ($userId) {
                                $query->where('id_admin', $userId);
                            })->count();
        
        $newApplications = JobApplication::whereHas('job', function($query) use ($userId) {
                                $query->where('id_admin', $userId);
                            })
                            ->where('status', 'pending')
                            ->count();
        
        $profileViews = 0; // This would typically come from an analytics service
        
        // Get recent applications
        $recentApplications = JobApplication::whereHas('job', function($query) use ($userId) {
                                $query->where('id_admin', $userId);
                            })
                            ->with(['user', 'job'])
                            ->latest()
                            ->take(5)
                            ->get();
        
        // Get company review statistics
        $averageRating = CompanyReview::where("admin_id", $userId)
            ->where("status", "approved")
            ->avg("rating") ?? 0;
            
        $totalReviews = CompanyReview::where("admin_id", $userId)
            ->where("status", "approved")
            ->count();
            
        $recentReviews = CompanyReview::where("admin_id", $userId)
            ->where("status", "approved")
            ->with("user")
            ->orderBy("created_at", "desc")
            ->limit(3)
            ->get();
        
        return view('employer.dashboard', compact(
            'activeJobs', 
            'totalApplications', 
            'newApplications', 
            'profileViews',
            'recentApplications',
            'averageRating',
            'totalReviews',
            'recentReviews'
        ));
    }
}
