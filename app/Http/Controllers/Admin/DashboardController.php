<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get counts for dashboard stats
        $totalUsers = User::count();
        $totalJobSeekers = User::where('role', 'jobseeker')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $activeJobs = Job::where('status', 'active')->count();
        
        // Get recent activities (this would typically be from an activities table)
        // For now, we'll simulate with recent user registrations
        $recentActivities = User::latest()->take(5)->get()->map(function ($user) {
            return (object) [
                'description' => "New user {$user->name} registered as {$user->role}",
                'created_at' => $user->created_at
            ];
        });
        
        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalJobSeekers', 
            'totalAdmins', 
            'activeJobs',
            'recentActivities'
        ));
    }
}
