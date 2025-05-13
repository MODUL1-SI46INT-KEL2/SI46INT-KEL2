{{-- resources/views/employer/jobs/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="px-6 py-8 bg-gray-900 text-white min-h-screen">
    <!-- JavaScript for dropdown functionality -->
    <script>
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            if (dropdown.classList.contains('hidden')) {
                // Close all other dropdowns first
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                    if (el.id !== dropdownId) {
                        el.classList.add('hidden');
                    }
                });
                // Open this dropdown
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        }
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const isDropdownButton = event.target.closest('button') && 
                                     event.target.closest('button').onclick && 
                                     event.target.closest('button').onclick.toString().includes('toggleDropdown');
            
            if (!isDropdownButton) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            }
        });
    </script>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-white">Manage Your Jobs</h1>
        <a href="{{ route('employer.jobs.create') }}" class="bg-[#B9FF66] hover:bg-[#a7e55c] px-4 py-2 rounded-lg text-sm font-medium text-gray-900 shadow-sm transition duration-200">
            Post New Job
        </a>
    </div>
    
    <!-- Search and Filter -->
    <div class="bg-gray-800 rounded-xl p-4 shadow-md border border-gray-700 mb-6">
        <form action="{{ route('employer.jobs.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-grow">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search jobs..." class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66] placeholder-gray-400">
            </div>
            <div class="flex gap-2">
                <select name="status" class="px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                    <option value="" {{ request('status') == '' ? 'selected' : '' }}>All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
                <button type="submit" class="bg-[#B9FF66] text-gray-900 px-4 py-2 rounded-lg hover:bg-[#a7e55c] transition duration-200">Filter</button>
            </div>
        </form>
    </div>
    
    @if(session('success'))
    <div class="bg-green-900 border-l-4 border-green-500 text-green-300 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif
    
    @if(session('error'))
    <div class="bg-red-900 border-l-4 border-red-500 text-red-300 p-4 mb-6" role="alert">
        <p>{{ session('error') }}</p>
    </div>
    @endif
    
    <!-- Job Listings -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($jobs as $job)
        <div class="bg-gray-800 rounded-2xl p-4 relative shadow-md border border-gray-700 h-[160px] overflow-hidden">
            <div class="flex justify-between items-start mb-2">
                <div class="w-3/4">
                    <h2 class="inline-block bg-[#B9FF66] text-gray-900 text-sm font-medium px-2 py-1 rounded-md mb-1">
                        {{ $job->title }}
                    </h2>
                    <p class="text-xs font-medium text-gray-300">{{ $job->job_type }}</p>
                </div>
                
                <div class="relative inline-block text-left">
                    <button type="button" onclick="toggleDropdown('dropdown-{{ $job->id_job }}')" class="focus:outline-none p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </button>
                    <div id="dropdown-{{ $job->id_job }}" class="hidden absolute right-0 mt-2 w-36 rounded-md shadow-lg bg-gray-800 border border-gray-700 z-50">
                        <div class="py-1" role="menu" aria-orientation="vertical">
                            <a href="{{ route('employer.jobs.edit', $job->id_job) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white" role="menuitem">Edit</a>
                            <a href="{{ route('employer.jobs.show', $job->id_job) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white" role="menuitem">View Details</a>
                            <form action="{{ route('employer.jobs.destroy', $job->id_job) }}" method="POST" class="block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-700 hover:text-red-300" role="menuitem" onclick="return confirm('Are you sure you want to delete this job?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="absolute inset-x-0 bottom-0 p-4 pt-0">
                <div class="flex justify-between items-center">
                    <div class="flex items-center text-xs text-gray-300">
                        @if($job->status == 'active')
                            <span class="bg-green-900 text-green-300 px-2 py-1 rounded-full text-xs font-medium mr-2">Active</span>
                        @elseif($job->status == 'draft')
                            <span class="bg-yellow-900 text-yellow-300 px-2 py-1 rounded-full text-xs font-medium mr-2">Draft</span>
                        @elseif($job->status == 'closed')
                            <span class="bg-red-900 text-red-300 px-2 py-1 rounded-full text-xs font-medium mr-2">Closed</span>
                        @endif
                        <span>{{ $job->application_count ?? 0 }} applications</span>
                    </div>
                    
                    <div class="flex space-x-3">
                        <a href="{{ route('employer.jobs.edit', $job->id_job) }}" class="text-xs font-medium text-[#B9FF66] hover:underline">
                            Edit
                        </a>
                        <a href="{{ route('employer.jobs.show', $job->id_job) }}" class="text-xs font-medium text-[#B9FF66] hover:underline">
                            View
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-gray-800 rounded-xl p-8 text-center border border-gray-700">
            <p class="text-gray-400 mb-4">You haven't posted any jobs yet.</p>
            <a href="{{ route('employer.jobs.create') }}" class="inline-block bg-[#B9FF66] hover:bg-[#a7e55c] px-4 py-2 rounded-lg text-sm font-medium text-gray-900 shadow-sm transition duration-200">
                Post Your First Job
            </a>
        </div>
        @endforelse
        
        <!-- Add New Job Card -->
        <a href="{{ route('employer.jobs.create') }}" class="block">
            <div class="bg-gray-800 rounded-2xl p-4 relative shadow-md border border-dashed border-gray-600 h-[160px] flex items-center justify-center hover:bg-gray-750 transition duration-200">
                <div class="text-center">
                    <div class="mx-auto bg-gray-700 rounded-full p-3 w-12 h-12 flex items-center justify-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-gray-300">Post New Job</p>
                </div>
            </div>
        </a>
    </div>
    
    <!-- Pagination -->
    <div class="mt-6">
        {{ $jobs->links() }}
    </div>
</div>
@endsection
