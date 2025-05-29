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
