<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewModerationController extends Controller
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
     * Display a listing of pending reviews for moderation.
     */
    public function index(Request $request)
    {
        $query = CompanyReview::with(['user', 'employer']);
        
        // Apply filters if provided
        if ($request->has('status') && in_array($request->status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', 'pending');
        }
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('employer', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        $reviews = $query->orderBy('created_at', 'desc')
            ->paginate(15);
            
        $pendingCount = CompanyReview::where('status', 'pending')->count();
        $approvedCount = CompanyReview::where('status', 'approved')->count();
        $rejectedCount = CompanyReview::where('status', 'rejected')->count();
        
        return view('admin.reviews.index', compact(
            'reviews', 
            'pendingCount', 
            'approvedCount', 
            'rejectedCount'
        ));
    }
    
    /**
     * Display a specific review for moderation.
     */
    public function show($id)
    {
        $review = CompanyReview::with(['user', 'employer'])
            ->findOrFail($id);
            
        return view('admin.reviews.show', compact('review'));
    }
    
    /**
     * Approve a review.
     */
    public function approve($id)
    {
        $review = CompanyReview::findOrFail($id);
        
        $review->status = 'approved';
        $review->moderated_at = now();
        $review->moderated_by = Auth::id();
        $review->save();
        
        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review has been approved and is now visible to users.');
    }
    
    /**
     * Reject a review with a reason.
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);
        
        $review = CompanyReview::findOrFail($id);
        
        $review->status = 'rejected';
        $review->rejection_reason = $request->rejection_reason;
        $review->moderated_at = now();
        $review->moderated_by = Auth::id();
        $review->save();
        
        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review has been rejected with feedback to the user.');
    }
    
    /**
     * Generate review statistics.
     */
    public function statistics()
    {
        // Basic counts
        $stats = [
            'total' => CompanyReview::count(),
            'pending' => CompanyReview::where("status", "pending")->count(),
            'approved' => CompanyReview::where("status", "approved")->count(),
            'rejected' => CompanyReview::where("status", "rejected")->count(),
        ];
        
        // Monthly comparison
        $currentMonth = now()->startOfMonth();
        $lastMonth = now()->subMonth()->startOfMonth();
        
        $stats['thisMonth'] = CompanyReview::whereDate("created_at", ">", $currentMonth)->count();
        $lastMonthCount = CompanyReview::whereDate("created_at", ">", $lastMonth)
            ->whereDate("created_at", "<", $currentMonth)
            ->count();
            
        // Calculate percentage changes
        $stats['monthlyChange'] = $lastMonthCount > 0 ? 
            round((($stats['thisMonth'] - $lastMonthCount) / $lastMonthCount) * 100) : 0;
        
        $totalLastMonth = CompanyReview::whereDate("created_at", "<", $currentMonth)->count();
        $stats['totalPercentChange'] = $totalLastMonth > 0 ? 
            round((($stats['total'] - $totalLastMonth) / $totalLastMonth) * 100) : 0;
        
        // Average ratings
        $stats['averageRating'] = CompanyReview::where("status", "approved")->avg("rating") ?? 0;
        $lastMonthAvg = CompanyReview::where("status", "approved")
            ->whereDate("created_at", ">", $lastMonth)
            ->whereDate("created_at", "<", $currentMonth)
            ->avg("rating") ?? 0;
        $stats['ratingChange'] = round($stats['averageRating'] - $lastMonthAvg, 1);
        
        // Rating distribution
        $ratingDistribution = CompanyReview::where("status", "approved")
            ->selectRaw("rating, count(*) as count")
            ->groupBy("rating")
            ->pluck("count", "rating")
            ->toArray();
            
        $stats['ratingDistribution'] = [];
        for ($i = 1; $i <= 5; $i++) {
            $stats['ratingDistribution'][$i] = $ratingDistribution[$i] ?? 0;
        }
        
        // Get recent reviews
        $recentReviews = CompanyReview::with(['user', 'employer'])
            ->orderBy("created_at", "desc")
            ->limit(10)
            ->get();
            
        // Get top rated companies
        $topCompanies = CompanyReview::where("status", "approved")
            ->selectRaw("admin_id, AVG(rating) as average_rating, COUNT(*) as review_count")
            ->groupBy("admin_id")
            ->having("review_count", ">", 2) // At least 3 reviews
            ->orderByDesc("average_rating")
            ->limit(5)
            ->get();
            
        // Get the employer names
        foreach ($topCompanies as $company) {
            $employer = User::find($company->admin_id);
            $company->name = $employer ? $employer->name : 'Unknown Company';
        }
            
        return view('admin.reviews.statistics', compact(
            'stats',
            'recentReviews',
            'topCompanies'
        ));
    }
}
