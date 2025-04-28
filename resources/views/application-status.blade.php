{{-- resources/views/application-status.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="px-6 py-10 max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold">Application Status</h1>
                <p class="text-gray-600 mt-2">Track the status of your job applications</p>
            </div>
            <a href="{{ route('search.jobs') }}" class="bg-[#B9FF66] hover:bg-[#a7e55c] px-4 py-2 rounded-lg text-sm font-medium flex items-center shadow-sm transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Apply for more jobs
            </a>
        </div>
        
        <!-- Status Filter -->
        <div class="flex space-x-2 mb-6">
            <button class="bg-black text-white px-4 py-2 rounded-lg text-sm font-medium">All ({{ $applications->count() }})</button>
            <button class="bg-white text-gray-800 px-4 py-2 rounded-lg text-sm font-medium border border-gray-200">Accepted ({{ $applications->where('status', 'accepted')->count() }})</button>
            <button class="bg-white text-gray-800 px-4 py-2 rounded-lg text-sm font-medium border border-gray-200">Rejected ({{ $applications->where('status', 'rejected')->count() }})</button>
            <button class="bg-white text-gray-800 px-4 py-2 rounded-lg text-sm font-medium border border-gray-200">Pending ({{ $applications->where('status', 'pending')->count() }})</button>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('warning'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('warning') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
            <!-- Application Cards -->
            <div class="divide-y divide-gray-200">
                @forelse($applications as $application)
                    <div class="p-6 hover:bg-gray-50 transition duration-150">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="flex items-center mb-1">
                                    <h2 class="text-lg font-semibold">{{ $application->job->title }}</h2>
                                    @if($application->status == 'accepted')
                                        <span class="ml-3 bg-[#B9FF66] text-black text-xs font-medium px-2.5 py-0.5 rounded-full">Accepted</span>
                                    @elseif($application->status == 'rejected')
                                        <span class="ml-3 bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Rejected</span>
                                    @else
                                        <span class="ml-3 bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Pending</span>
                                    @endif
                                </div>
                                <p class="text-gray-600 text-sm mb-3">{{ isset($jobPosters[$application->job->id_admin]) && isset($companyProfiles[$jobPosters[$application->job->id_admin]->company_profile_id]) ? $companyProfiles[$jobPosters[$application->job->id_admin]->company_profile_id]->name : $application->job->company }}</p>
                                
                                <div class="flex items-center text-xs text-gray-500 mb-4">
                                    <div class="flex items-center mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Applied on {{ $application->created_at->format('M d, Y') }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $application->job->location }}
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('jobs.show', $application->job->id_job) }}" class="text-sm text-blue-600 hover:underline">View Details</a>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-2">
                                <button class="text-gray-400 hover:text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center">
                        <p class="text-gray-500">You haven't applied to any jobs yet.</p>
                        <a href="{{ route('search.jobs') }}" class="mt-2 inline-block text-blue-600 hover:underline">Browse Jobs</a>
                    </div>
                @endforelse
            </div>
        </div>
        
        <!-- Application Timeline -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <h2 class="text-xl font-bold mb-4">Application Timeline</h2>
            <div class="relative border-l-2 border-gray-200 ml-3 pt-2 pb-1">
                @if($applications->count() > 0)
                    @foreach($applications as $application)
                        <div class="mb-6 ml-6">
                            <div class="absolute -left-3">
                                @if($application->status == 'accepted')
                                    <div class="bg-green-500 rounded-full w-5 h-5 border-4 border-white"></div>
                                @elseif($application->status == 'rejected')
                                    <div class="bg-red-500 rounded-full w-5 h-5 border-4 border-white"></div>
                                @else
                                    <div class="bg-blue-500 rounded-full w-5 h-5 border-4 border-white"></div>
                                @endif
                            </div>
                            <div class="text-xs text-gray-500 mb-1">{{ $application->created_at->format('F d, Y') }}</div>
                            <div class="font-medium">
                                @if($application->status == 'accepted')
                                    Application accepted at {{ $application->job->company }}
                                @elseif($application->status == 'rejected')
                                    Application rejected at {{ $application->job->company }}
                                @else
                                    Applied for {{ $application->job->title }} at {{ $application->job->company }}
                                @endif
                            </div>
                            <p class="text-sm text-gray-600 mt-1">
                                @if($application->status == 'accepted')
                                    Your application for {{ $application->job->title }} has been accepted. The recruiter will contact you soon.
                                @elseif($application->status == 'rejected')
                                    Your application for {{ $application->job->title }} has been rejected. Thank you for your interest.
                                @else
                                    Your application has been submitted successfully.
                                @endif
                            </p>
                        </div>
                    @endforeach
                @else
                    <div class="ml-6 py-4">
                        <p class="text-gray-500">No application history yet.</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Recommended Jobs Based on Applications -->
        <div>
            <h2 class="text-xl font-bold mb-4">Recommended Jobs</h2>
            <p class="text-gray-600 text-sm mb-4">Based on your application history</p>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition duration-200">
                    <div class="flex items-start mb-3">
                        <img src="https://logo.clearbit.com/danacita.co.id" alt="DANA Indonesia" class="w-10 h-10 object-contain rounded mr-3">
                        <div>
                            <h3 class="font-medium">Business Intelligence Analyst</h3>
                            <p class="text-sm text-gray-600">DANA Indonesia</p>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500 mb-3">Jakarta, Indonesia • Full-time</div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-medium text-gray-500">Posted 2 days ago</span>
                        <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-800">Apply</a>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition duration-200">
                    <div class="flex items-start mb-3">
                        <img src="https://logo.clearbit.com/accenture.com" alt="Accenture Indonesia" class="w-10 h-10 object-contain rounded mr-3">
                        <div>
                            <h3 class="font-medium">Supply Chain Consultant</h3>
                            <p class="text-sm text-gray-600">Accenture Indonesia</p>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500 mb-3">Jakarta, Indonesia • Full-time</div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-medium text-gray-500">Posted 5 days ago</span>
                        <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-800">Apply</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
