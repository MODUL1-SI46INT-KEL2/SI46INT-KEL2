{{-- resources/views/saved-jobs.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl font-bold mb-8">Saved Jobs</h1>
            
            @if($savedJobs->isEmpty())
                <div class="bg-gray-800 text-white rounded-lg p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <h2 class="text-2xl font-semibold mb-2">No saved jobs yet</h2>
                    <p class="text-gray-400 mb-6">Start exploring job listings and save the ones you're interested in.</p>
                    <a href="#" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-black bg-[#B9FF66] hover:bg-[#a8e65c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66]">
                        Browse Jobs
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @endif

            @foreach($savedJobs as $index => $savedJob)
                @php
                    $job = $savedJob->job;
                    $cardStyle = '';
                    $textClass = 'text-white';
                    $bgClass = 'bg-gray-900';
                    $secondaryTextClass = 'text-gray-400';
                    $pillBgClass = 'bg-gray-800';
                    $pillTextClass = 'text-white';
                    
                    if ($index % 3 == 1) {
                        $bgClass = 'bg-gray-100';
                        $textClass = 'text-gray-900';
                        $secondaryTextClass = 'text-gray-600';
                        $pillBgClass = 'bg-gray-200';
                        $pillTextClass = 'text-gray-800';
                    } else if ($index % 3 == 0) {
                        $cardStyle = 'background-color: #B9FF66;';
                        $bgClass = '';
                        $textClass = 'text-black';
                        $secondaryTextClass = 'text-gray-700';
                        $pillBgClass = 'bg-white';
                        $pillTextClass = 'text-gray-800';
                    }
                @endphp
                
                <div x-data="{ 
                    loved: true,
                    removeSavedJob() {
                        const jobId = {{ $job->id_job }};
                        fetch(`/jobs/${jobId}/unsave`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            credentials: 'same-origin'
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Remove the card with animation
                            const card = this.$el;
                            card.style.opacity = '0';
                            card.style.transform = 'scale(0.95)';
                            setTimeout(() => {
                                card.remove();
                                // Check if no more saved jobs
                                if (document.querySelectorAll('.job-card').length === 0) {
                                    window.location.reload();
                                }
                            }, 300);
                        });
                    }
                }" 
                class="job-card {{ $bgClass }} {{ $textClass }} rounded-2xl p-6 relative shadow-sm transition-all duration-300" 
                style="{{ $cardStyle }}">
                    <button @click="removeSavedJob()" class="absolute top-4 right-4 transition-transform hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 fill-red-500" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>
                    <a href="{{ route('jobs.show', ['job_id' => $job->id_job]) }}" class="block">
                        <h3 class="text-lg font-semibold mb-2">{{ $job->title }}</h3>
                        <p class="{{ $secondaryTextClass }} text-sm mb-2">{{ $job->company }}</p>
                        <p class="{{ $secondaryTextClass }} text-sm mb-4">{{ $job->location }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs {{ $pillBgClass }} {{ $pillTextClass }} px-3 py-1 rounded-full">{{ $job->job_type }}</span>
                            <span class="text-xs {{ $secondaryTextClass }}">{{ $job->salary_range }}</span>
                        </div>
                    </a>
                </div>
            @endforeach
            
            @if(!$savedJobs->isEmpty())
                </div>
                
                <div class="flex justify-center mt-8">
                    {{ $savedJobs->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
