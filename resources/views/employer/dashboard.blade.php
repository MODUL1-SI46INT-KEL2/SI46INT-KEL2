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

        <!-- Shortlisted Candidates Widget -->
        <div class="block">
            <div class="bg-[#B9FF66] rounded-2xl p-4 relative h-[160px] border border-gray-900">
                <div class="bg-white inline-block px-2 py-1 rounded-md text-sm font-medium text-gray-900">
                    Shortlisted
                </div>
                
                @if(isset($shortlistedCandidates) && count($shortlistedCandidates) > 0)
                    <div class="mt-2 space-y-2">
                        @foreach($shortlistedCandidates as $candidate)
                            <div class="bg-black bg-opacity-10 rounded-lg p-2 cursor-pointer text-xs"
                                 onclick="openCandidateModal('{{ $candidate->user->id }}')">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        @if($candidate->user->profile_image)
                                            <img src="{{ asset('storage/' . $candidate->user->profile_image) }}" 
                                                 alt="{{ $candidate->user->name }}" 
                                                 class="w-8 h-8 rounded-full object-cover border-2 border-gray-900">
                                        @else
                                            <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center border-2 border-gray-900">
                                                <span class="text-white font-medium">{{ substr($candidate->user->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 flex justify-between items-center">
                                        <span class="font-medium text-gray-900">{{ $candidate->user->name }}</span>
                                        <span class="text-gray-700 text-xs">{{ $candidate->status_updated_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-700 text-sm mt-2">No shortlisted candidates</p>
                @endif
            </div>
        </div>
    </div>    
    
    

</div>

<!-- Candidate Modal Template -->
<div id="candidateModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-gray-800 rounded-xl p-6 max-w-lg w-full mx-4">
        <div class="flex justify-between items-start mb-4">
            <h3 class="text-lg font-semibold text-white" id="modalCandidateName"></h3>
            <button onclick="closeCandidateModal()" class="text-gray-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="modalContent" class="space-y-4">
            <!-- Content will be populated by JavaScript -->
        </div>
        <div class="flex justify-end space-x-3 mt-6">
            <button onclick="downloadResume()" class="bg-[#B9FF66] text-black px-4 py-2 rounded-lg hover:bg-opacity-90">
                Download Resume
            </button>
            <button onclick="removeFromShortlist()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                Remove from Shortlist
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openCandidateModal(candidateId) {
        fetch(`/employer/candidates/${candidateId}/details`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalCandidateName').textContent = data.name;
                document.getElementById('modalContent').innerHTML = `
                    <div class="space-y-3">
                        <p class="text-gray-300"><span class="font-medium">Email:</span> ${data.email}</p>
                        <p class="text-gray-300"><span class="font-medium">Phone:</span> ${data.phone}</p>
                        <p class="text-gray-300"><span class="font-medium">Experience:</span> ${data.experience} years</p>
                        <p class="text-gray-300"><span class="font-medium">Skills:</span> ${data.skills}</p>
                        <div class="bg-gray-700 rounded p-3">
                            <p class="text-gray-300"><span class="font-medium">Notes:</span></p>
                            <p class="text-gray-300 mt-1">${data.note || 'No notes added'}</p>
                        </div>
                    </div>
                `;
                document.getElementById('candidateModal').classList.remove('hidden');
                document.getElementById('candidateModal').classList.add('flex');
            });
    }

    function closeCandidateModal() {
        document.getElementById('candidateModal').classList.add('hidden');
        document.getElementById('candidateModal').classList.remove('flex');
    }

    function contactCandidate(candidateId) {
        event.stopPropagation();
        window.location.href = `/employer/messages/create/${candidateId}`;
    }

    function downloadResume() {
        // Implement resume download logic
    }

    function removeFromShortlist() {
        // Implement remove from shortlist logic
        closeCandidateModal();
    }

    // Close modal when clicking outside
    document.getElementById('candidateModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCandidateModal();
        }
    });
</script>
@endpush
