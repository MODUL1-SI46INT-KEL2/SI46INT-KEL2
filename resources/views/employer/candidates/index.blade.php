@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
        <h1 class="text-2xl font-bold text-white mb-6">Candidate Listing</h1>
        
        <!-- Search and Filter Form -->
        <form action="{{ route('employer.candidates.index') }}" method="GET" class="mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-300 mb-1">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                        class="w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66]"
                        placeholder="Search by name or skills">
                </div>
                
                <div>
                    <label for="skills" class="block text-sm font-medium text-gray-300 mb-1">Skills</label>
                    <input type="text" name="skills" id="skills" value="{{ request('skills') }}" 
                        class="w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66]"
                        placeholder="e.g. PHP, Laravel, JavaScript">
                </div>
                
                <div>
                    <label for="experience" class="block text-sm font-medium text-gray-300 mb-1">Experience</label>
                    <input type="text" name="experience" id="experience" value="{{ request('experience') }}" 
                        class="w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66]"
                        placeholder="e.g. Web Developer, 5 years">
                </div>
                
                <div>
                    <label for="education" class="block text-sm font-medium text-gray-300 mb-1">Education</label>
                    <input type="text" name="education" id="education" value="{{ request('education') }}" 
                        class="w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66]"
                        placeholder="e.g. Computer Science">
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div class="flex flex-col md:flex-row gap-4">
                    <div>
                        <label for="sort_by" class="block text-sm font-medium text-gray-300 mb-1">Sort By</label>
                        <select name="sort_by" id="sort_by" 
                            class="bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Date Registered</option>
                            <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-300 mb-1">Order</label>
                        <select name="sort_order" id="sort_order" 
                            class="bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                            <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                            <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex gap-2">
                    <button type="submit" class="bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-medium py-2 px-4 rounded-md">
                        Apply Filters
                    </button>
                    <a href="{{ route('employer.candidates.index') }}" class="bg-gray-600 hover:bg-gray-500 text-white font-medium py-2 px-4 rounded-md">
                        Reset
                    </a>
                </div>
            </div>
        </form>
        
        <!-- Results Count -->
        <div class="text-gray-300 mb-4">
            Found {{ $candidates->total() }} candidates
        </div>
        
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
                        
                        <div class="mt-4 md:mt-0">
                            <a href="{{ route('employer.candidates.show', $candidate->id) }}" 
                               class="inline-block bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-medium py-2 px-4 rounded-md">
                                View Profile
                            </a>
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
