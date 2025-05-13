{{-- resources/views/employer/applications/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="px-6 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-white">Job Applications</h1>
    </div>
    
    <!-- Search and Filter -->
    <div class="bg-gray-800 rounded-xl p-4 shadow-sm border border-gray-700 mb-6">
        <form action="{{ route('employer.applications.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-grow">
                <input type="text" name="search" placeholder="Search applications..." value="{{ request('search') }}" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66] placeholder-gray-400">
            </div>
            <div class="flex gap-2">
                <select name="status" class="px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="reviewing" {{ request('status') == 'reviewing' ? 'selected' : '' }}>Reviewing</option>
                    <option value="shortlisted" {{ request('status') == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                    <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                <select name="job_id" class="px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                    <option value="">All Jobs</option>
                    @foreach($jobs as $job)
                        <option value="{{ $job->id_job }}" {{ request('job_id') == $job->id_job ? 'selected' : '' }}>{{ $job->title }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-[#B9FF66] text-gray-900 px-4 py-2 rounded-lg font-medium hover:bg-[#a7e55c] transition-colors">Filter</button>
            </div>
        </form>
    </div>
    
    <!-- Applications Table -->
    <div class="bg-gray-800 rounded-xl shadow-sm border border-gray-700 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-900">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Applicant</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Job Position</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Applied On</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-700">
                @forelse($applications as $application)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-gray-700 flex items-center justify-center text-gray-300 mr-3">
                                {{ substr($application->user->name, 0, 1) }}{{ substr(explode(' ', $application->user->name)[1] ?? '', 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm font-medium text-white">{{ $application->user->name }}</div>
                                <div class="text-xs text-gray-400">{{ $application->user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-white">{{ $application->job->title }}</div>
                        <div class="text-xs text-gray-400">{{ $application->job->employment_type }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $statusColors = [
                                'pending' => 'yellow',
                                'reviewing' => 'blue',
                                'shortlisted' => 'indigo',
                                'accepted' => 'green',
                                'rejected' => 'red',
                                'withdrawn' => 'gray'
                            ];
                            $color = $statusColors[$application->status] ?? 'gray';
                        @endphp
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color == 'yellow' ? 'bg-yellow-500 text-black' : 'bg-'.$color.'-500 text-white' }}">
                            {{ ucfirst($application->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                        {{ $application->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex flex-wrap gap-2">
                        <a href="{{ route('employer.applications.show', $application->id) }}" class="text-blue-400 hover:text-blue-300">View Application</a>
                        <a href="{{ route('employer.candidates.show', $application->user->id) }}" class="text-purple-400 hover:text-purple-300 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            View Profile
                        </a>
                        @if($application->status == 'pending' || $application->status == 'reviewing' || $application->status == 'shortlisted')
                            <a href="{{ route('employer.applications.update-status', ['id' => $application->id, 'status' => 'accepted']) }}" class="text-green-400 hover:text-green-300">Accept</a>
                            <a href="{{ route('employer.applications.update-status', ['id' => $application->id, 'status' => 'rejected']) }}" class="text-red-400 hover:text-red-300">Reject</a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p>No applications found</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <!-- Pagination -->
        <div class="px-6 py-3 flex items-center justify-between border-t border-gray-200">
            {{ $applications->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
