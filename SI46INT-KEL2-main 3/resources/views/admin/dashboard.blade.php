{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="px-6 py-8 bg-gray-900 text-white">
    <h1 class="text-2xl font-bold mb-6 text-white">Admin Dashboard</h1>
    
    <!-- Main Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-gray-800 rounded-xl p-4 shadow-md border border-gray-700">
            <h2 class="text-sm text-gray-400 mb-1">Total Users</h2>
            <p class="text-2xl font-bold text-white">{{ $totalUsers ?? 0 }}</p>
        </div>
        
        <div class="bg-gray-800 rounded-xl p-4 shadow-md border border-gray-700">
            <h2 class="text-sm text-gray-400 mb-1">Job Seekers</h2>
            <p class="text-2xl font-bold text-white">{{ $totalJobSeekers ?? 0 }}</p>
        </div>
        
        <div class="bg-gray-800 rounded-xl p-4 shadow-md border border-gray-700">
            <h2 class="text-sm text-gray-400 mb-1">Admins</h2>
            <p class="text-2xl font-bold text-white">{{ $totalAdmins ?? 0 }}</p>
        </div>
        
        <div class="bg-gray-800 rounded-xl p-4 shadow-md border border-gray-700">
            <h2 class="text-sm text-gray-400 mb-1">Active Jobs</h2>
            <p class="text-2xl font-bold text-white">{{ $activeJobs ?? 0 }}</p>
        </div>
    </div>
    
    <!-- Admin Action Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Manage Users Card -->
        <a href="{{ route('admin.users') ?? '#' }}" class="block">
            <div class="bg-[#B9FF66] rounded-2xl p-4 relative h-[160px] border border-gray-700">
                <div class="bg-gray-800 inline-block px-2 py-1 rounded-md text-sm font-medium text-white">
                    Manage Users
                </div>
                
                <div class="absolute bottom-4 left-4">
                    <div class="bg-black rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>
        
        <!-- Manage Jobs Card -->
        <a href="{{ route('admin.jobs.index') }}" class="block">
            <div class="bg-[#B9FF66] rounded-2xl p-4 relative h-[160px] border border-gray-700">
                <div class="bg-gray-800 inline-block px-2 py-1 rounded-md text-sm font-medium text-white">
                    Manage Jobs
                </div>
                
                <div class="absolute bottom-4 left-4">
                    <div class="bg-black rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>
        
        <!-- Job Listing Card -->
        <a href="{{ route('admin.jobs.create') }}" class="block">
            <div class="bg-[#B9FF66] rounded-2xl p-4 relative h-[160px] border border-gray-700">
                <div class="bg-gray-800 inline-block px-2 py-1 rounded-md text-sm font-medium text-white">
                    Post a Job
                </div>
                
                <div class="absolute bottom-4 left-4">
                    <div class="bg-black rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>
        
        <!-- Manage Companies Card -->
        <a href="{{ route('admin.companies') ?? '#' }}" class="block">
            <div class="bg-[#B9FF66] rounded-2xl p-4 relative h-[160px] border border-gray-700">
                <div class="bg-gray-800 inline-block px-2 py-1 rounded-md text-sm font-medium text-white">
                    Manage Companies
                </div>
                
                <div class="absolute bottom-4 left-4">
                    <div class="bg-black rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
    <!-- Recent Activity -->
    <div class="bg-gray-800 rounded-xl p-6 shadow-md border border-gray-700">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-white">Recent Activity</h2>
            <a href="#" class="text-[#B9FF66] text-sm font-medium hover:underline">View All</a>
        </div>
        
        @if(isset($recentActivities) && count($recentActivities) > 0)
            <div class="space-y-4">
                @foreach($recentActivities as $activity)
                    <div class="flex items-start border-b border-gray-700 pb-4">
                        <div class="bg-gray-700 rounded-full p-2 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-white">{{ $activity->description }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-400 text-sm">No recent activities to display.</p>
        @endif
    </div>
</div>
@endsection
