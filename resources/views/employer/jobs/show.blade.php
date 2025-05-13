{{-- resources/views/employer/jobs/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="px-6 py-8 bg-gray-900 text-white min-h-screen">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-white">Job Details</h1>
        <div>
            <a href="{{ route('employer.jobs.edit', $job->id_job) }}" class="bg-[#B9FF66] hover:bg-[#a7e55c] px-4 py-2 rounded-lg text-sm font-medium text-gray-900 shadow-sm transition duration-200 mr-2">
                Edit Job
            </a>
            <a href="{{ route('employer.jobs.index') }}" class="text-gray-300 hover:text-white transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to Jobs
            </a>
        </div>
    </div>
    
    <!-- Job Details Card -->
    <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 overflow-hidden mb-8">
        <div class="p-6">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h2 class="text-xl font-bold text-white">{{ $job->title }}</h2>
                    <p class="text-gray-300">{{ $job->company }}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-sm font-medium 
                    @if($job->status == 'active') bg-green-900 text-green-300 
                    @elseif($job->status == 'draft') bg-yellow-900 text-yellow-300 
                    @else bg-red-900 text-red-300 @endif">
                    {{ ucfirst($job->status) }}
                </span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="flex items-center text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ $job->location }}</span>
                </div>
                <div class="flex items-center text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ $job->position_type }}</span>
                </div>
                <div class="flex items-center text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                    </svg>
                    <span>${{ number_format($job->salary, 2) }}</span>
                </div>
            </div>
            
            <div class="mb-6">
                <h3 class="text-lg font-medium text-white mb-2">Job Description</h3>
                <div class="text-gray-300 whitespace-pre-line">{{ $job->description }}</div>
            </div>
            
            <div class="flex items-center text-sm text-gray-400">
                <span>Posted: {{ $job->posting_date ? date('M d, Y', strtotime($job->posting_date)) : date('M d, Y', strtotime($job->created_at)) }}</span>
                <span class="mx-2">•</span>
                <span>Job Type: {{ $job->job_type }}</span>
                <span class="mx-2">•</span>
                <span>Category: {{ $job->category }}</span>
            </div>
        </div>
    </div>
    
    <!-- Applications Section -->
    <div class="mb-6">
        <h2 class="text-xl font-bold text-white mb-4">Applications ({{ count($applications) }})</h2>
        
        @if(count($applications) > 0)
            <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-900">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Applicant</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Applied On</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @foreach($applications as $application)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-gray-700 flex items-center justify-center text-gray-300 mr-3">
                                            {{ substr($application->user->name ?? 'User', 0, 2) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-white">{{ $application->user->name ?? 'User' }}</div>
                                            <div class="text-xs text-gray-400">{{ $application->user->email ?? 'Email not available' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($application->status == 'pending') bg-yellow-900 text-yellow-300 
                                        @elseif($application->status == 'reviewed') bg-blue-900 text-blue-300 
                                        @elseif($application->status == 'interviewed') bg-purple-900 text-purple-300 
                                        @elseif($application->status == 'accepted') bg-green-900 text-green-300 
                                        @elseif($application->status == 'rejected') bg-red-900 text-red-300 
                                        @endif">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ date('M d, Y', strtotime($application->created_at)) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('employer.applications.show', $application->id) }}" class="text-[#B9FF66] hover:text-[#a7e55c] mr-3">View</a>
                                    
                                    @if($application->status != 'accepted' && $application->status != 'rejected')
                                        <form action="{{ route('employer.applications.update-status', $application->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="accepted">
                                            <button type="submit" class="text-green-400 hover:text-green-300 mr-3">Accept</button>
                                        </form>
                                        
                                        <form action="{{ route('employer.applications.update-status', $application->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="text-red-400 hover:text-red-300">Reject</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 p-6 text-center">
                <p class="text-gray-400">No applications have been received for this job yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection
