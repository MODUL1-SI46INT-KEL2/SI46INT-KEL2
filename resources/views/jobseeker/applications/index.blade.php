@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">My Applications</h1>
        
        <!-- Search Form -->
        <form action="{{ route('jobseeker.applications.index') }}" method="GET" class="flex">
            <input type="text" name="search" value="{{ $search ?? '' }}" 
                placeholder="Search jobs or companies" 
                class="px-4 py-2 bg-white text-gray-900 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
            <button type="submit" class="bg-[#B9FF66] text-gray-900 px-4 py-2 rounded-r-lg hover:bg-opacity-80">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </form>
    </div>
    
    <!-- Status Filter Tabs -->
    <div class="flex flex-wrap mb-6 bg-gray-800 rounded-lg p-1">
        <a href="{{ route('jobseeker.applications.index') }}" 
            class="px-4 py-2 rounded-lg {{ !$status ? 'bg-[#B9FF66] text-gray-900 font-medium' : 'text-gray-300 hover:bg-gray-700' }}">
            All <span class="ml-1 px-2 py-0.5 text-xs rounded-full {{ !$status ? 'bg-gray-900 text-[#B9FF66]' : 'bg-gray-700 text-gray-300' }}">{{ $statusCounts['all'] }}</span>
        </a>
        <a href="{{ route('jobseeker.applications.index', ['status' => 'pending']) }}" 
            class="px-4 py-2 rounded-lg {{ $status === 'pending' ? 'bg-[#B9FF66] text-gray-900 font-medium' : 'text-gray-300 hover:bg-gray-700' }}">
            Pending <span class="ml-1 px-2 py-0.5 text-xs rounded-full {{ $status === 'pending' ? 'bg-gray-900 text-[#B9FF66]' : 'bg-gray-700 text-gray-300' }}">{{ $statusCounts['pending'] }}</span>
        </a>
        <a href="{{ route('jobseeker.applications.index', ['status' => 'reviewing']) }}" 
            class="px-4 py-2 rounded-lg {{ $status === 'reviewing' ? 'bg-[#B9FF66] text-gray-900 font-medium' : 'text-gray-300 hover:bg-gray-700' }}">
            Reviewing <span class="ml-1 px-2 py-0.5 text-xs rounded-full {{ $status === 'reviewing' ? 'bg-gray-900 text-[#B9FF66]' : 'bg-gray-700 text-gray-300' }}">{{ $statusCounts['reviewing'] }}</span>
        </a>
        <a href="{{ route('jobseeker.applications.index', ['status' => 'shortlisted']) }}" 
            class="px-4 py-2 rounded-lg {{ $status === 'shortlisted' ? 'bg-[#B9FF66] text-gray-900 font-medium' : 'text-gray-300 hover:bg-gray-700' }}">
            Shortlisted <span class="ml-1 px-2 py-0.5 text-xs rounded-full {{ $status === 'shortlisted' ? 'bg-gray-900 text-[#B9FF66]' : 'bg-gray-700 text-gray-300' }}">{{ $statusCounts['shortlisted'] }}</span>
        </a>
        <a href="{{ route('jobseeker.applications.index', ['status' => 'accepted']) }}" 
            class="px-4 py-2 rounded-lg {{ $status === 'accepted' ? 'bg-[#B9FF66] text-gray-900 font-medium' : 'text-gray-300 hover:bg-gray-700' }}">
            Accepted <span class="ml-1 px-2 py-0.5 text-xs rounded-full {{ $status === 'accepted' ? 'bg-gray-900 text-[#B9FF66]' : 'bg-gray-700 text-gray-300' }}">{{ $statusCounts['accepted'] }}</span>
        </a>
        <a href="{{ route('jobseeker.applications.index', ['status' => 'rejected']) }}" 
            class="px-4 py-2 rounded-lg {{ $status === 'rejected' ? 'bg-[#B9FF66] text-gray-900 font-medium' : 'text-gray-300 hover:bg-gray-700' }}">
            Rejected <span class="ml-1 px-2 py-0.5 text-xs rounded-full {{ $status === 'rejected' ? 'bg-gray-900 text-[#B9FF66]' : 'bg-gray-700 text-gray-300' }}">{{ $statusCounts['rejected'] }}</span>
        </a>
    </div>
    
    <!-- Applications List -->
    @if($applications->count() > 0)
        <div class="bg-gray-800 rounded-lg overflow-hidden">
            @foreach($applications as $application)
                <a href="{{ route('jobseeker.applications.show', $application->id) }}" 
                   class="block border-b border-gray-700 hover:bg-gray-700 transition-colors">
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-medium text-white">{{ $application->job->title }}</h3>
                                <p class="text-gray-400">{{ isset($jobPosters[$application->job->id_admin]) && isset($companyProfiles[$jobPosters[$application->job->id_admin]->company_profile_id]) ? $companyProfiles[$jobPosters[$application->job->id_admin]->company_profile_id]->name : $application->job->company }}</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-xs text-gray-400">Applied {{ $application->created_at->diffForHumans() }}</span>
                                    <span class="mx-2 text-gray-600">•</span>
                                    <span class="text-xs text-gray-400">{{ $application->job->location }}</span>
                                </div>
                            </div>
                            
                            <!-- Status Badge -->
                            <div>
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
                                <span class="px-3 py-1 text-xs rounded-full text-white {{ $statusColor }}">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Last Status Update -->
                        <div class="flex justify-between items-center mt-3">
                            @if($application->status_updated_at)
                                <div class="text-xs text-gray-400">
                                    Status updated {{ $application->status_updated_at->diffForHumans() }}
                                </div>
                            @else
                                <div></div>
                            @endif
                            
                            <!-- Give Review Button -->
                            @php
                                $hasReview = \App\Models\CompanyReview::where('user_id', auth()->id())
                                    ->where('admin_id', $application->job->id_admin)
                                    ->exists();
                            @endphp
                            
                            @if(!$hasReview)
                                <a href="{{ route('reviews.create', $application->job->id_admin) }}" 
                                   class="inline-flex items-center px-3 py-1 bg-transparent border border-[#B9FF66] rounded-lg text-[#B9FF66] text-xs hover:bg-[#B9FF66] hover:text-gray-900 transition-colors"
                                   onclick="event.stopPropagation();">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    Give Review
                                </a>
                            @elseif(\App\Models\CompanyReview::where('user_id', auth()->id())
                                    ->where('admin_id', $application->job->id_admin)
                                    ->whereIn('status', ['pending', 'rejected'])
                                    ->exists())
                                <a href="{{ route('reviews.edit', \App\Models\CompanyReview::where('user_id', auth()->id())->where('admin_id', $application->job->id_admin)->first()->id) }}" 
                                   class="inline-flex items-center px-3 py-1 bg-transparent border border-yellow-500 rounded-lg text-yellow-500 text-xs hover:bg-yellow-500 hover:text-gray-900 transition-colors"
                                   onclick="event.stopPropagation();">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit Review
                                </a>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-6">
            {{ $applications->links() }}
        </div>
    @else
        <div class="bg-gray-800 rounded-lg p-8 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="mt-4 text-xl font-medium text-white">No applications found</h3>
            <p class="mt-2 text-gray-400">
                @if($search)
                    No applications match your search criteria. Try a different search.
                @elseif($status)
                    You don't have any {{ $status }} applications.
                @else
                    You haven't applied to any jobs yet. Start applying to track your applications here.
                @endif
            </p>
            <a href="#" class="mt-4 inline-block px-4 py-2 bg-[#B9FF66] text-gray-900 rounded-lg hover:bg-opacity-80">
                Browse Jobs
            </a>
        </div>
    @endif
</div>
@endsection
