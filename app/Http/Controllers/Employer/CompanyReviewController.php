<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyReview;
use App\Models\User;

class CompanyReviewController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('dashboard')
                    ->with('error', 'You do not have permission to access this page.');
            }
            return $next($request);
        });
    }
    
    /**
     * Display a listing of reviews for the employer's company.
     */
    public function index(Request $request)
    {
        $employerId = Auth::id();
        
        $query = CompanyReview::where('admin_id', $employerId)
            ->where('status', 'approved')
            ->with('user');
            
        // Apply filters if provided
        if ($request->has('rating') && in_array($request->rating, [1, 2, 3, 4, 5])) {
            $query->where('rating', $request->rating);
        }
        
        if ($request->has('sort') && in_array($request->sort, ['newest', 'oldest', 'highest', 'lowest'])) {
            switch ($request->sort) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'highest':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'lowest':
                    $query->orderBy('rating', 'asc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
        
        $reviews = $query->paginate(10);
        
        // Calculate average rating and rating distribution
        $averageRating = CompanyReview::where('admin_id', $employerId)
            ->where('status', 'approved')
            ->avg('rating') ?? 0;
            
        $totalReviews = CompanyReview::where('admin_id', $employerId)
            ->where('status', 'approved')
            ->count();
            
        $ratingDistribution = CompanyReview::where('admin_id', $employerId)
            ->where('status', 'approved')
            ->selectRaw('rating, count(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();
            
        // Ensure all ratings have values
        for ($i = 1; $i <= 5; $i++) {
            if (!isset($ratingDistribution[$i])) {
                $ratingDistribution[$i] = 0;
            }
        }
        
        // Get recent positive and negative reviews
        $positiveReviews = CompanyReview::where('admin_id', $employerId)
            ->where('status', 'approved')
            ->where('rating', '>=', 4)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
            
        $negativeReviews = CompanyReview::where('admin_id', $employerId)
            ->where('status', 'approved')
            ->where('rating', '<=', 2)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
            
        return view('employer.reviews.index', compact(
            'reviews', 
            'averageRating', 
            'totalReviews', 
            'ratingDistribution',
            'positiveReviews',
            'negativeReviews'
        ));
    }
    
    /**
     * Display a summary of company reviews on employer dashboard.
     */
    public function dashboardSummary()
    {
        $employerId = Auth::id();
        
        $averageRating = CompanyReview::where('admin_id', $employerId)
            ->where('status', 'approved')
            ->avg('rating') ?? 0;
            
        $totalReviews = CompanyReview::where('admin_id', $employerId)
            ->where('status', 'approved')
            ->count();
            
        $recentReviews = CompanyReview::where('admin_id', $employerId)
            ->where('status', 'approved')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
            
        return view('employer.reviews.dashboard-widget', compact(
            'averageRating',
            'totalReviews',
            'recentReviews'
        ));
    }
    
    /**
     * Display a specific review.
     */
    public function show($id)
    {
        $employerId = Auth::id();
        
        $review = CompanyReview::where('id', $id)
            ->where('admin_id', $employerId)
            ->where('status', 'approved')
            ->with('user')
            ->firstOrFail();
            
        return view('employer.reviews.show', compact('review'));
    }
}
