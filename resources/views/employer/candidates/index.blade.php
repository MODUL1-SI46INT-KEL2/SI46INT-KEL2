@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
        <h1 class="text-2xl font-bold text-white mb-6">Candidate Listing</h1>
        
        <!-- Candidates List -->
        <div class="space-y-4">
            @forelse ($candidates as $candidate)
                <div class="bg-gray-700 border border-gray-600 rounded-lg p-4 hover:bg-gray-650 transition">
                    <div class="flex flex-col md:flex-row justify-between">
                        <div>
                            <h3 class="text-xl font-semibold text-white">{{ $candidate->name }}</h3>
                            @if($candidate->jobseekerProfile && $candidate->jobseekerProfile->job_title)
                                <p class="text-gray-300 text-sm mt-1">{{ $candidate->jobseekerProfile->job_title }}</p>
                            @endif
                            @if($candidate->jobseekerProfile && $candidate->jobseekerProfile->location)
                                <p class="text-gray-300 text-sm">{{ $candidate->jobseekerProfile->location }}</p>
                            @endif
                            
                            @if($candidate->jobseekerProfile && $candidate->jobseekerProfile->skills)
                                <div class="mt-2">
                                    <h4 class="text-sm font-medium text-gray-300">Skills:</h4>
                                    <div class="flex flex-wrap gap-2 mt-1">
                                        @foreach(explode(',', $candidate->jobseekerProfile->skills) as $skill)
                                            <span class="bg-gray-600 text-gray-200 px-2 py-1 rounded text-xs">{{ trim($skill) }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            @if($candidate->jobseekerProfile && $candidate->jobseekerProfile->experience)
                                <div class="mt-2">
                                    <h4 class="text-sm font-medium text-gray-300">Experience:</h4>
                                    <p class="text-gray-300 text-sm">{{ Str::limit($candidate->jobseekerProfile->experience, 100) }}</p>
                                </div>
                            @endif
                            
                            @if($candidate->jobseekerProfile && $candidate->jobseekerProfile->education)
                                <div class="mt-2">
                                    <h4 class="text-sm font-medium text-gray-300">Education:</h4>
                                    <p class="text-gray-300 text-sm">{{ Str::limit($candidate->jobseekerProfile->education, 100) }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-gray-700 border border-gray-600 rounded-lg p-6 text-center">
                    <p class="text-gray-300">No candidates found matching your criteria.</p>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="mt-6">
            {{ $candidates->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
