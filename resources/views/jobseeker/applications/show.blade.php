@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('jobseeker.applications.index') }}" class="text-[#B9FF66] hover:underline flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Applications
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Application Details -->
        <div class="lg:col-span-2">
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-white">{{ $application->job->title }}</h1>
                        <p class="text-gray-400">{{ isset($jobPoster) && isset($companyProfiles[$jobPoster->company_profile_id]) ? $companyProfiles[$jobPoster->company_profile_id]->name : $application->job->company }}</p>
                    </div>
                    
                    <!-- Status Badge -->
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-500',
                            'reviewing' => 'bg-blue-500',
                            'shortlisted' => 'bg-purple-500',
                            'accepted' => 'bg-green-500',
                            'rejected' => 'bg-red-500',
                            'withdrawn' => 'bg-gray-500',
                        ];
                        $statusColor = $statusColors[$application->status] ?? 'bg-gray-500';
                    @endphp
                    <span class="px-3 py-1 text-sm rounded-full text-white {{ $statusColor }}">
                        {{ ucfirst($application->status) }}
                    </span>
                </div>
                
                <div class="mt-4 grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-400">Applied On</p>
                        <p class="text-white">{{ $application->created_at->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Last Updated</p>
                        <p class="text-white">{{ $application->status_updated_at ? $application->status_updated_at->format('M d, Y') : 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Location</p>
                        <p class="text-white">{{ $application->job->location }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Job Type</p>
                        <p class="text-white">{{ $application->job->type }}</p>
                    </div>
                </div>
                
                <!-- Job Description -->
                <div class="mt-6">
                    <h2 class="text-lg font-medium text-white mb-2">Job Description</h2>
                    <div class="text-gray-300 space-y-2">
                        {!! nl2br(e($application->job->description)) !!}
                    </div>
                </div>
                
                <!-- Cover Letter -->
                @if($application->cover_letter)
                    <div class="mt-6">
                        <h2 class="text-lg font-medium text-white mb-2">Your Cover Letter</h2>
                        <div class="bg-gray-700 rounded-lg p-4 text-gray-300">
                            {!! nl2br(e($application->cover_letter)) !!}
                        </div>
                    </div>
                @endif
                
                <!-- Resume -->
                @if($application->resume_path)
                    <div class="mt-6">
                        <h2 class="text-lg font-medium text-white mb-2">Your Resume</h2>
                        <a href="{{ asset('storage/' . $application->resume_path) }}" target="_blank" 
                           class="flex items-center bg-gray-700 rounded-lg p-3 text-white hover:bg-gray-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            View Resume
                        </a>
                    </div>
                @endif
                
                <!-- Actions -->
                <div class="mt-8 flex space-x-4">
                    <!-- Message Employer -->
                    <a href="{{ route('messages.create', ['recipient_id' => $application->job->id_admin, 'job_id' => $application->job->id_job]) }}" 
                       class="px-4 py-2 bg-[#B9FF66] text-gray-900 rounded-lg hover:bg-opacity-80 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        Message Employer
                    </a>
                    
                    <!-- Withdraw Application (only if not already accepted/rejected) -->
                    @if(!in_array($application->status, ['accepted', 'rejected', 'withdrawn']))
                        <form action="{{ route('jobseeker.applications.withdraw', $application->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" onclick="return confirm('Are you sure you want to withdraw this application? This action cannot be undone.')" 
                                    class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Withdraw Application
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Application Timeline -->
        <div class="lg:col-span-1">
            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-lg font-medium text-white mb-4">Application Timeline</h2>
                
                <!-- Timeline items as cards -->
                <div class="space-y-4">
                    @foreach($timeline as $item)
                        <div class="bg-gray-700 rounded-lg p-4 relative {{ $item['current'] ? 'border-2 border-[#B9FF66]' : 'border border-gray-600' }}">
                            <!-- Status indicator -->
                            <div class="absolute -left-2 top-1/2 transform -translate-y-1/2 w-4 h-4 rounded-full
                                {{ $item['completed'] ? 'bg-[#B9FF66]' : 'bg-gray-500' }}">
                            </div>
                            
                            <div class="flex items-center mb-2">
                                <!-- Status icon -->
                                <div class="mr-3 w-8 h-8 rounded-full flex items-center justify-center
                                    {{ $item['completed'] ? 'bg-[#B9FF66] text-gray-900' : 'bg-gray-600 text-gray-300' }}">
                                    @if($item['completed'])
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
                                <h3 class="text-md font-medium {{ $item['current'] ? 'text-[#B9FF66]' : 'text-white' }}">
                                    {{ $item['title'] }}
                                </h3>
                            </div>
                            
                            <!-- Description -->
                            <div class="ml-11">
                                <p class="text-sm text-gray-300">{{ $item['description'] }}</p>
                                @if($item['date'])
                                    <p class="text-xs text-gray-400 mt-1">{{ $item['date']->format('M d, Y - g:i A') }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Company Review Section -->
                <div class="mt-8 border-t border-gray-700 pt-6">
                    <h3 class="text-lg font-medium text-white mb-4">Company Review</h3>
                    
                    @php
                        $hasReview = \App\Models\CompanyReview::where('user_id', auth()->id())
                            ->where('admin_id', $application->job->id_admin)
                            ->first();
                    @endphp
                    
                    @if(!$hasReview)
                        <div class="bg-gray-700 rounded-lg p-4">
                            <p class="text-gray-300 mb-4">Share your experience with this company to help other job seekers make informed decisions.</p>
                            <a href="{{ route('reviews.create', $application->job->id_admin) }}" 
                               class="inline-flex items-center px-4 py-2 bg-[#B9FF66] text-gray-900 rounded-lg hover:bg-opacity-80 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                Write a Review
                            </a>
                        </div>
                    @elseif($hasReview->status == 'pending')
                        <div class="bg-yellow-500 bg-opacity-10 border border-yellow-500 rounded-lg p-4">
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-white font-medium">Your review is pending approval</p>
                                    <p class="text-gray-300 mt-1">Your review has been submitted and is awaiting moderation by the employer.</p>
                                    <div class="mt-3">
                                        <a href="{{ route('reviews.edit', $hasReview->id) }}" class="text-yellow-500 hover:underline">Edit Review</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($hasReview->status == 'rejected')
                        <div class="bg-red-500 bg-opacity-10 border border-red-500 rounded-lg p-4">
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-white font-medium">Your review was not approved</p>
                                    <p class="text-gray-300 mt-1">Reason: {{ $hasReview->rejection_reason }}</p>
                                    <div class="mt-3">
                                        <a href="{{ route('reviews.edit', $hasReview->id) }}" class="text-red-400 hover:underline">Edit and Resubmit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($hasReview->status == 'approved')
                        <div class="bg-green-500 bg-opacity-10 border border-green-500 rounded-lg p-4">
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <div>
                                    <p class="text-white font-medium">Your review has been published</p>
                                    <p class="text-gray-300 mt-1">Thank you for sharing your experience with this company!</p>
                                    <div class="mt-3">
                                        <a href="{{ route('reviews.employer', $application->job->id_admin) }}" class="text-green-400 hover:underline">View All Company Reviews</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
