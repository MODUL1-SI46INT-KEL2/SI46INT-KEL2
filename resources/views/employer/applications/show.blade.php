{{-- resources/views/employer/applications/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="px-6 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-white">Application Details</h1>
        <a href="{{ route('employer.applications.index') }}" class="text-[#B9FF66] hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Applications
        </a>
    </div>
    
    @if(session('success'))
    <div class="bg-gray-800 border-l-4 border-[#B9FF66] text-white p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif
    
    @if(session('error'))
    <div class="bg-gray-800 border-l-4 border-red-500 text-white p-4 mb-6" role="alert">
        <p>{{ session('error') }}</p>
    </div>
    @endif
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Main Application Details -->
        <div class="md:col-span-2">
            <div class="bg-gray-800 rounded-xl shadow-sm border border-gray-700 overflow-hidden mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-white">{{ $application->job->title }}</h2>
                        <span class="px-3 py-1 rounded-full text-sm font-medium 
                            @if($application->status == 'pending') bg-yellow-100 text-yellow-800 
                            @elseif($application->status == 'reviewing') bg-blue-100 text-blue-800 
                            @elseif($application->status == 'shortlisted') bg-purple-100 text-purple-800 
                            @elseif($application->status == 'accepted') bg-green-100 text-green-800 
                            @elseif($application->status == 'rejected') bg-red-100 text-red-800 
                            @elseif($application->status == 'withdrawn') bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($application->status) }}
                        </span>
                    </div>
                    
                    <div class="mb-6">
                        <p class="text-gray-400">{{ $application->job->company }}</p>
                        <p class="text-gray-400">{{ $application->job->location }} • {{ $application->job->position_type }} • {{ $application->job->job_type }}</p>
                        <p class="text-gray-400 mt-1">Applied on: {{ date('M d, Y', strtotime($application->created_at)) }}</p>
                    </div>
                    
                    @if($application->cover_letter)
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-2 text-white">Cover Letter</h3>
                        <div class="bg-gray-700 p-4 rounded-lg border border-gray-600 whitespace-pre-line text-gray-300">
                            {{ $application->cover_letter }}
                        </div>
                    </div>
                    @endif
                    
                    @if($application->resume_path)
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-2 text-white">Resume</h3>
                        <a href="{{ route('employer.applications.download-resume', $application->id) }}" 
                           class="inline-flex items-center bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            Download Resume
                        </a>
                    </div>
                    @endif
                    
                    <!-- Application Status Update Form -->
                    <div class="mt-8">
                        <h3 class="text-lg font-medium mb-2 text-white">Update Application Status</h3>
                        <form action="{{ route('employer.applications.update-status', $application->id) }}" method="POST" class="flex flex-wrap gap-2">
                            @csrf
                            @method('PUT')
                            
                            <button type="submit" name="status" value="pending" 
                                class="px-4 py-2 rounded-lg text-sm font-medium {{ $application->status == 'pending' ? 'bg-yellow-100 text-yellow-800 border-2 border-yellow-300' : 'bg-gray-100 hover:bg-gray-200 text-gray-800' }}">
                                Pending
                            </button>
                            
                            <button type="submit" name="status" value="reviewing" 
                                class="px-4 py-2 rounded-lg text-sm font-medium {{ $application->status == 'reviewing' ? 'bg-blue-100 text-blue-800 border-2 border-blue-300' : 'bg-gray-100 hover:bg-gray-200 text-gray-800' }}">
                                Reviewing
                            </button>
                            
                            <button type="submit" name="status" value="shortlisted" 
                                class="px-4 py-2 rounded-lg text-sm font-medium {{ $application->status == 'shortlisted' ? 'bg-purple-100 text-purple-800 border-2 border-purple-300' : 'bg-gray-100 hover:bg-gray-200 text-gray-800' }}">
                                Shortlisted
                            </button>
                            
                            <button type="submit" name="status" value="accepted" 
                                class="px-4 py-2 rounded-lg text-sm font-medium {{ $application->status == 'accepted' ? 'bg-green-100 text-green-800 border-2 border-green-300' : 'bg-gray-100 hover:bg-gray-200 text-gray-800' }}">
                                Accept
                            </button>
                            
                            <button type="submit" name="status" value="rejected" 
                                class="px-4 py-2 rounded-lg text-sm font-medium {{ $application->status == 'rejected' ? 'bg-red-100 text-red-800 border-2 border-red-300' : 'bg-gray-100 hover:bg-gray-200 text-gray-800' }}">
                                Reject
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Applicant Information Sidebar -->
        <div>
            <div class="bg-gray-800 rounded-xl shadow-sm border border-gray-700 overflow-hidden mb-6">
                <div class="p-6">
                    <h2 class="text-lg font-bold mb-4 text-white">Applicant Information</h2>
                    
                    <div class="flex items-center mb-4">
                        <div class="h-16 w-16 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 mr-4 text-xl">
                            {{ substr($application->user->name ?? 'User', 0, 2) }}
                        </div>
                        <div>
                            <h3 class="font-medium text-white">{{ $application->user->name ?? 'User' }}</h3>
                            <p class="text-gray-400 text-sm">{{ $application->user->email ?? 'Email not available' }}</p>
                        </div>
                    </div>
                    
                    @if($application->user->phone)
                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-gray-400 mb-1">Phone</h4>
                        <p class="text-white">{{ $application->user->phone }}</p>
                    </div>
                    @endif
                    
                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-gray-400 mb-1">Applied On</h4>
                        <p class="text-white">{{ date('F d, Y', strtotime($application->created_at)) }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-gray-400 mb-1">Application Status</h4>
                        <p class="capitalize text-white">{{ $application->status }}</p>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('employer.candidates.show', $application->user->id) }}" class="block w-full bg-gray-700 hover:bg-gray-600 text-center px-4 py-2 rounded-lg text-sm font-medium text-white border border-gray-600 shadow-sm transition duration-200 mb-2 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            View Full Profile
                        </a>
                        <a href="mailto:{{ $application->user->email ?? '' }}" class="block w-full bg-[#B9FF66] hover:bg-[#a7e55c] text-center px-4 py-2 rounded-lg text-sm font-medium text-gray-900 shadow-sm transition duration-200 mb-2">
                            Contact Applicant
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Application Timeline -->
            <div class="bg-gray-800 rounded-xl shadow-sm border border-gray-700 overflow-hidden">
                <div class="p-6">
                    <h2 class="text-lg font-bold mb-4 text-white">Application Timeline</h2>
                    
                    <!-- Timeline items as cards -->
                    <div class="space-y-4">
                        <!-- Application Submitted -->
                        <div class="bg-gray-700 rounded-lg p-4 relative {{ $application->status === 'pending' ? 'border-2 border-[#B9FF66]' : 'border border-gray-600' }}">
                            <!-- Status indicator -->
                            <div class="absolute -left-2 top-1/2 transform -translate-y-1/2 w-4 h-4 rounded-full bg-green-500"></div>
                            
                            <div class="flex items-center mb-2">
                                <!-- Status icon -->
                                <div class="mr-3 w-8 h-8 rounded-full flex items-center justify-center bg-green-500 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                
                                <!-- Title -->
                                <h3 class="text-md font-medium {{ $application->status === 'pending' ? 'text-[#B9FF66]' : 'text-white' }}">
                                    Application Submitted
                                </h3>
                            </div>
                            
                            <!-- Description -->
                            <div class="ml-11">
                                <p class="text-sm text-gray-300">Submitted successfully</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $application->created_at->format('M d, Y - g:i A') }}</p>
                            </div>
                        </div>
                        
                        <!-- Under Review -->
                        <div class="bg-gray-700 rounded-lg p-4 relative {{ $application->status === 'reviewing' ? 'border-2 border-[#B9FF66]' : 'border border-gray-600' }}">
                            <!-- Status indicator -->
                            <div class="absolute -left-2 top-1/2 transform -translate-y-1/2 w-4 h-4 rounded-full
                                {{ in_array($application->status, ['reviewing', 'shortlisted', 'accepted', 'rejected']) ? 'bg-blue-500' : 'bg-gray-500' }}"></div>
                            
                            <div class="flex items-center mb-2">
                                <!-- Status icon -->
                                <div class="mr-3 w-8 h-8 rounded-full flex items-center justify-center
                                    {{ in_array($application->status, ['reviewing', 'shortlisted', 'accepted', 'rejected']) ? 'bg-blue-500 text-white' : 'bg-gray-600 text-gray-300' }}">
                                    @if(in_array($application->status, ['reviewing', 'shortlisted', 'accepted', 'rejected']))
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @endif
                                </div>
                                
                                <!-- Title -->
                                <h3 class="text-md font-medium {{ $application->status === 'reviewing' ? 'text-[#B9FF66]' : 'text-white' }}">
                                    Under Review
                                </h3>
                            </div>
                            
                            <!-- Description -->
                            <div class="ml-11">
                                <p class="text-sm text-gray-300">Being reviewed</p>
                                @if($application->status_updated_at && in_array($application->status, ['reviewing', 'shortlisted', 'accepted', 'rejected']))
                                    <p class="text-xs text-gray-400 mt-1">{{ $application->status_updated_at->format('M d, Y - g:i A') }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Shortlisted -->
                        <div class="bg-gray-700 rounded-lg p-4 relative {{ $application->status === 'shortlisted' ? 'border-2 border-[#B9FF66]' : 'border border-gray-600' }}">
                            <!-- Status indicator -->
                            <div class="absolute -left-2 top-1/2 transform -translate-y-1/2 w-4 h-4 rounded-full
                                {{ in_array($application->status, ['shortlisted', 'accepted', 'rejected']) ? 'bg-purple-500' : 'bg-gray-500' }}"></div>
                            
                            <div class="flex items-center mb-2">
                                <!-- Status icon -->
                                <div class="mr-3 w-8 h-8 rounded-full flex items-center justify-center
                                    {{ in_array($application->status, ['shortlisted', 'accepted', 'rejected']) ? 'bg-purple-500 text-white' : 'bg-gray-600 text-gray-300' }}">
                                    @if(in_array($application->status, ['shortlisted', 'accepted', 'rejected']))
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @endif
                                </div>
                                
                                <!-- Title -->
                                <h3 class="text-md font-medium {{ $application->status === 'shortlisted' ? 'text-[#B9FF66]' : 'text-white' }}">
                                    Shortlisted
                                </h3>
                            </div>
                            
                            <!-- Description -->
                            <div class="ml-11">
                                <p class="text-sm text-gray-300">Selected for consideration</p>
                                @if($application->status_updated_at && in_array($application->status, ['shortlisted', 'accepted', 'rejected']))
                                    <p class="text-xs text-gray-400 mt-1">{{ $application->status_updated_at->format('M d, Y - g:i A') }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Final Decision -->
                        <div class="bg-gray-700 rounded-lg p-4 relative {{ in_array($application->status, ['accepted', 'rejected']) ? 'border-2 border-[#B9FF66]' : 'border border-gray-600' }}">
                            <!-- Status indicator -->
                            <div class="absolute -left-2 top-1/2 transform -translate-y-1/2 w-4 h-4 rounded-full
                                {{ in_array($application->status, ['accepted', 'rejected']) ? ($application->status === 'accepted' ? 'bg-green-500' : 'bg-red-500') : 'bg-gray-500' }}"></div>
                            
                            <div class="flex items-center mb-2">
                                <!-- Status icon -->
                                <div class="mr-3 w-8 h-8 rounded-full flex items-center justify-center
                                    {{ in_array($application->status, ['accepted', 'rejected']) ? ($application->status === 'accepted' ? 'bg-green-500' : 'bg-red-500') : 'bg-gray-600' }} text-white">
                                    @if(in_array($application->status, ['accepted', 'rejected']))
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @endif
                                </div>
                                
                                <!-- Title -->
                                <h3 class="text-md font-medium {{ in_array($application->status, ['accepted', 'rejected']) ? 'text-[#B9FF66]' : 'text-white' }}">
                                    {{ in_array($application->status, ['accepted', 'rejected']) ? ($application->status === 'accepted' ? 'Accepted' : 'Rejected') : 'Final Decision' }}
                                </h3>
                            </div>
                            
                            <!-- Description -->
                            <div class="ml-11">
                                <p class="text-sm text-gray-300">
                                    {{ in_array($application->status, ['accepted', 'rejected']) ? ($application->status === 'accepted' ? 'Congratulations!' : 'Not selected') : 'Awaiting decision' }}
                                </p>
                                @if($application->status_updated_at && in_array($application->status, ['accepted', 'rejected']))
                                    <p class="text-xs text-gray-400 mt-1">{{ $application->status_updated_at->format('M d, Y - g:i A') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
