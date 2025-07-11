{{-- resources/views/employer/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="px-6 py-8 bg-gray-900 text-white min-h-screen">
    <h1 class="text-2xl font-bold text-white mb-6">Employer Dashboard</h1>
    
    <!-- Main Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-gray-800 rounded-xl p-4 shadow-md border border-gray-700">
            <h2 class="text-sm text-gray-400 mb-1">Active Jobs</h2>
            <p class="text-2xl font-bold text-white">{{ $activeJobs ?? 0 }}</p>
        </div>
        
        <div class="bg-gray-800 rounded-xl p-4 shadow-md border border-gray-700">
            <h2 class="text-sm text-gray-400 mb-1">Total Applications</h2>
            <p class="text-2xl font-bold text-white">{{ $totalApplications ?? 0 }}</p>
        </div>
        
        <div class="bg-gray-800 rounded-xl p-4 shadow-md border border-gray-700">
            <h2 class="text-sm text-gray-400 mb-1">New Applications</h2>
            <p class="text-2xl font-bold text-white">{{ $newApplications ?? 0 }}</p>
        </div>
        
        <div class="bg-gray-800 rounded-xl p-4 shadow-md border border-gray-700">
            <h2 class="text-sm text-gray-400 mb-1">Profile Views</h2>
            <p class="text-2xl font-bold text-white">{{ $profileViews ?? 0 }}</p>
        </div>
    </div>
    
    <!-- Employer Action Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        <!-- Post Job Card removed as requested -->
        
        <!-- Manage Jobs Card -->
        <a href="{{ route('employer.jobs.index') }}" class="block">
            <div class="bg-[#B9FF66] rounded-2xl p-4 relative h-[160px] border border-gray-900">
                <div class="bg-white inline-block px-2 py-1 rounded-md text-sm font-medium text-gray-900">
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
        
        <!-- View Applications Card -->
        <a href="{{ route('employer.applications.index') }}" class="block">
            <div class="bg-[#B9FF66] rounded-2xl p-4 relative h-[160px] border border-gray-900">
                <div class="bg-white inline-block px-2 py-1 rounded-md text-sm font-medium text-gray-900">
                    View Applications
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
        
        <!-- Company Reviews Card -->
        <a href="{{ route('employer.reviews.index') }}" class="block">
            <div class="bg-[#B9FF66] rounded-2xl p-4 relative h-[160px] border border-gray-900">
                <div class="bg-white inline-block px-2 py-1 rounded-md text-sm font-medium text-gray-900">
                    Company Reviews
                </div>
                <div class="mt-2 text-xs text-gray-800">View ratings and feedback from job seekers</div>
                
                <div class="absolute bottom-4 left-4">
                    <div class="bg-black rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>
        
        <!-- Company Profile Card -->
        <a href="{{ route('employer.profile.edit') }}" class="block">
            <div class="bg-[#B9FF66] rounded-2xl p-4 relative h-[160px] border border-gray-900">
                <div class="bg-white inline-block px-2 py-1 rounded-md text-sm font-medium text-gray-900">
                    Company Profile
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
    
            <!-- Browse Candidates Card -->
        <a href="{{ route('employer.candidates.index') }}" class="block">
            <div class="bg-[#B9FF66] rounded-2xl p-4 relative h-[160px] border border-gray-900">
                <div class="bg-white inline-block px-2 py-1 rounded-md text-sm font-medium text-gray-900">
                    Browse Candidates
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

        <!-- Recently Shortlisted -->
        <div class="bg-[#B9FF66] rounded-2xl p-4 relative h-[160px] border border-gray-900">
            <div class="bg-white inline-block px-2 py-1 rounded-md text-sm font-medium text-gray-900">
                Recently Shortlisted
            </div>
            
            @if(isset($shortlistedCandidates) && count($shortlistedCandidates) > 0)
                <div class="mt-4 flex justify-center" style="gap: 58px;">
                    @foreach($shortlistedCandidates->take(3) as $candidate)
                        <a href="{{ route('employer.candidates.show', $candidate->user->id) }}" 
                           class="flex flex-col items-center group hover:scale-105 transition-transform candidate-item"
                           data-candidate-id="{{ $candidate->user->id }}">
                            <div class="bg-gray-800 rounded-full p-2 w-12 h-12 flex items-center justify-center mb-2 group-hover:ring-2 group-hover:ring-gray-900 relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                <button onclick="toggleHideCandidate({{ $candidate->user->id }})" 
                                        class="absolute -top-1 -right-1 bg-gray-900 rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600"
                                        title="Hide candidate">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <div class="bg-white px-3 py-1 rounded-full group-hover:bg-gray-900 group-hover:text-white transition-colors">
                                <span class="text-sm font-medium text-gray-900 group-hover:text-white">{{ $candidate->user->name }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="h-full flex items-center justify-center">
                    <p class="text-gray-700 text-sm">No shortlisted candidates</p>
                </div>
            @endif
        </div>
    </div>    
    
    

</div>

@endsection
