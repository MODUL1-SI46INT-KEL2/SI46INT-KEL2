{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-900 to-gray-800 py-12 px-6">
    <div class="max-w-7xl mx-auto">
        <!-- Welcome Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white">Welcome, {{ Auth::user()->name }}</h1>
                <p class="text-gray-400 mt-1">{{ now()->format('l, F j, Y') }}</p>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Saved Jobs</p>
                        <h3 class="text-3xl font-bold text-white mt-1">{{ \App\Models\SavedJob::where('user_id', Auth::id())->count() }}</h3>
                    </div>
                    <div class="bg-gray-700 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('saved-jobs.index') }}" class="text-[#B9FF66] text-sm font-medium flex items-center">
                        View all
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>




        </div>

        <!-- Job Recommendations -->
        <h2 class="text-xl font-bold text-white mb-6">Recommended Jobs</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">
            @php
                // Get recommended jobs - newest jobs first
                $recommendedJobs = \App\Models\Job::where('status', 'active')
                    ->latest('posting_date')
                    ->take(6)
                    ->get();
                
                // Get user's saved jobs for comparison
                $savedJobIds = [];
                if (Auth::check()) {
                    $savedJobIds = \App\Models\SavedJob::where('user_id', Auth::id())
                        ->pluck('job_id')
                        ->toArray();
                }
                
                // Get company profiles to access logos and company names
                $companyProfiles = \App\Models\CompanyProfile::all()->keyBy('id');
                
                // Get the users who posted these jobs to access their company profiles
                $jobPosters = \App\Models\User::whereIn('id', $recommendedJobs->pluck('id_admin'))
                    ->get()
                    ->keyBy('id');
            @endphp
            
            @forelse($recommendedJobs as $job)
                <div class="bg-gray-800 hover:bg-gray-700 rounded-xl border border-gray-700 shadow-sm transition-all duration-300 hover:shadow-md hover:-translate-y-1 overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-1">{{ $job->title }}</h3>
                                <p class="text-gray-400 text-sm">{{ isset($jobPosters[$job->id_admin]) && isset($companyProfiles[$jobPosters[$job->id_admin]->company_profile_id]) ? $companyProfiles[$jobPosters[$job->id_admin]->company_profile_id]->name : $job->company }}</p>
                            </div>
                            <div>
                                @if(in_array($job->id_job, $savedJobIds))
                                    <button 
                                        onclick="unsaveJob({{ $job->id_job }})" 
                                        class="text-[#B9FF66] hover:text-[#a8e65c] p-1.5 rounded-full focus:outline-none"
                                        id="save-btn-{{ $job->id_job }}"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                @else
                                    <button 
                                        onclick="saveJob({{ $job->id_job }})" 
                                        class="text-gray-400 hover:text-[#B9FF66] p-1.5 rounded-full focus:outline-none"
                                        id="save-btn-{{ $job->id_job }}"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-gray-700 text-gray-300 text-xs font-medium px-2.5 py-1 rounded">
                                {{ $job->job_type }}
                            </span>
                            <span class="bg-gray-700 text-gray-300 text-xs font-medium px-2.5 py-1 rounded">
                                {{ $job->location }}
                            </span>
                            @if($job->salary)
                                <span class="bg-gray-700 text-gray-300 text-xs font-medium px-2.5 py-1 rounded">
                                    {{ $job->salary }}
                                </span>
                            @endif
                        </div>
                        
                        <p class="text-gray-400 text-sm line-clamp-2 mb-4">{{ Str::limit($job->description, 120) }}</p>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">
                                @if($job->posting_date)
                                    Posted {{ \Carbon\Carbon::parse($job->posting_date)->diffForHumans() }}
                                @else
                                    Recently posted
                                @endif
                            </span>
                            <a href="{{ route('jobs.show', ['job_id' => $job->id_job]) }}" class="text-[#B9FF66] text-sm font-medium hover:underline">View Details</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-gray-800 rounded-xl border border-gray-700 p-8 text-center">
                    <p class="text-gray-400 mb-4">No job recommendations available at this time.</p>
                    <a href="{{ route('search.jobs') }}" class="inline-block px-5 py-3 bg-[#B9FF66] text-black rounded-lg font-medium hover:bg-[#a8e65c] transition-colors">
                        Search for Jobs
                    </a>
                </div>
            @endforelse
        </div>
        
        <div class="flex justify-center mb-10">
            <a href="#" class="inline-flex items-center px-6 py-3 bg-[#B9FF66] text-black rounded-lg font-medium hover:bg-[#a8e65c] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                View All Jobs
            </a>
        </div>
        
        <script>
            function saveJob(jobId) {
                fetch(`/jobs/${jobId}/save`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    credentials: 'same-origin'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.saved) {
                        const saveBtn = document.getElementById(`save-btn-${jobId}`);
                        saveBtn.classList.remove('text-gray-400');
                        saveBtn.classList.add('text-[#B9FF66]');
                        saveBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" /></svg>`;
                        saveBtn.setAttribute('onclick', `unsaveJob(${jobId})`);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
            
            function unsaveJob(jobId) {
                fetch(`/jobs/${jobId}/unsave`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    credentials: 'same-origin'
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.saved) {
                        const saveBtn = document.getElementById(`save-btn-${jobId}`);
                        saveBtn.classList.remove('text-[#B9FF66]');
                        saveBtn.classList.add('text-gray-400');
                        saveBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>`;
                        saveBtn.setAttribute('onclick', `saveJob(${jobId})`);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        </script>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 gap-8">

        </div>
    </div>
</div>
@endsection
