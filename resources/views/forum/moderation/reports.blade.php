@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <div class="flex items-center text-gray-300 text-sm">
                <a href="{{ route('forum.index') }}" class="hover:text-[#B9FF66] transition-colors">Forum</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-white">Moderation</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-white">Reports</span>
            </div>
        </div>
        
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-white">Forum Moderation</h1>
            <p class="text-gray-300 mt-1">Manage reported content and take appropriate actions.</p>
        </div>
        
        <!-- Tabs -->
        <div class="border-b border-gray-700 mb-6">
            <div class="flex">
                <button id="pending-tab" onclick="showTab('pending')" class="px-4 py-2 text-white font-medium border-b-2 border-[#B9FF66] -mb-px">
                    Pending Reports ({{ $pendingReports->total() }})
                </button>
                <button id="resolved-tab" onclick="showTab('resolved')" class="px-4 py-2 text-gray-400 hover:text-white font-medium border-b-2 border-transparent -mb-px">
                    Resolved Reports ({{ $resolvedReports->total() }})
                </button>
            </div>
        </div>
        
        <!-- Pending Reports Tab -->
        <div id="pending-content" class="space-y-6">
            @if($pendingReports->count() > 0)
                @foreach($pendingReports as $report)
                    <div class="bg-gray-700 rounded-lg overflow-hidden border border-gray-600">
                        <div class="p-5">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center">
                                        <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full mr-2">
                                            {{ ucfirst($report->reason) }}
                                        </span>
                                        <span class="text-gray-300 text-sm">
                                            Reported {{ $report->created_at->diffForHumans() }} by {{ $report->user->name }}
                                        </span>
                                    </div>
                                    
                                    <h3 class="text-lg font-semibold text-white mt-2">
                                        @if($report->reportable_type === 'App\\Models\\ForumThread')
                                            Thread: {{ $report->reportable->title }}
                                        @else
                                            Reply in: {{ $report->reportable->thread->title }}
                                        @endif
                                    </h3>
                                    
                                    @if($report->description)
                                        <div class="mt-2 p-3 bg-gray-800 rounded-md text-gray-300 text-sm">
                                            <strong class="text-white">Report Description:</strong><br>
                                            {{ $report->description }}
                                        </div>
                                    @endif
                                    
                                    <div class="mt-3 p-3 bg-gray-800 rounded-md text-gray-300">
                                        <strong class="text-white">Reported Content:</strong><br>
                                        @if($report->reportable_type === 'App\\Models\\ForumThread')
                                            {{ Str::limit($report->reportable->content, 200) }}
                                        @else
                                            {{ Str::limit($report->reportable->content, 200) }}
                                        @endif
                                    </div>
                                    
                                    <div class="mt-3 text-sm">
                                        <a href="{{ $report->reportable_type === 'App\\Models\\ForumThread' 
                                            ? route('forum.thread', ['categorySlug' => $report->reportable->category->slug, 'threadSlug' => $report->reportable->slug]) 
                                            : route('forum.thread', ['categorySlug' => $report->reportable->thread->category->slug, 'threadSlug' => $report->reportable->thread->slug]) . '#reply-' . $report->reportable->id }}" 
                                           class="text-[#B9FF66] hover:underline" target="_blank">
                                            View in context
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Moderation Actions -->
                            <div class="mt-4 pt-4 border-t border-gray-600">
                                <form action="{{ route('forum.moderation.handle-report', $report->id) }}" method="POST">
                                    @csrf
                                    <div class="flex flex-col md:flex-row gap-4">
                                        <div class="flex-1">
                                            <label for="admin_notes_{{ $report->id }}" class="block text-white text-sm font-medium mb-1">Admin Notes (Optional)</label>
                                            <textarea id="admin_notes_{{ $report->id }}" name="admin_notes" rows="2" 
                                                    class="w-full bg-gray-800 text-white border border-gray-600 rounded-md p-2 text-sm focus:border-[#B9FF66] focus:ring focus:ring-[#B9FF66] focus:ring-opacity-50"
                                                    placeholder="Add notes about this moderation action..."></textarea>
                                        </div>
                                        
                                        <div class="flex md:flex-col justify-end space-x-2 md:space-x-0 md:space-y-2">
                                            <button type="submit" name="action" value="dismiss" class="bg-gray-600 hover:bg-gray-500 text-white py-2 px-4 rounded-md text-sm">
                                                Dismiss
                                            </button>
                                            <button type="submit" name="action" value="hide" class="bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-4 rounded-md text-sm">
                                                Hide (Soft Delete)
                                            </button>
                                            <button type="submit" name="action" value="delete" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md text-sm">
                                                Delete Permanently
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <!-- Pagination -->
                <div class="mt-6">
                    {{ $pendingReports->links() }}
                </div>
            @else
                <div class="bg-gray-700 rounded-lg p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-gray-300 text-lg">No pending reports to review.</p>
                </div>
            @endif
        </div>
        
        <!-- Resolved Reports Tab (Hidden by Default) -->
        <div id="resolved-content" class="space-y-6 hidden">
            @if($resolvedReports->count() > 0)
                @foreach($resolvedReports as $report)
                    <div class="bg-gray-700 rounded-lg overflow-hidden border border-gray-600">
                        <div class="p-5">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center flex-wrap gap-2">
                                        <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">
                                            {{ ucfirst($report->reason) }}
                                        </span>
                                        
                                        @if($report->status === 'dismissed')
                                            <span class="bg-gray-500 text-white text-xs px-2 py-0.5 rounded-full">Dismissed</span>
                                        @elseif($report->status === 'resolved')
                                            <span class="bg-green-500 text-white text-xs px-2 py-0.5 rounded-full">Resolved</span>
                                        @endif
                                        
                                        <span class="text-gray-300 text-sm">
                                            Reported {{ $report->created_at->format('M d, Y') }} • Handled {{ $report->reviewed_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                    
                                    <h3 class="text-lg font-semibold text-white mt-2">
                                        @if($report->reportable_type === 'App\\Models\\ForumThread')
                                            Thread: {{ $report->reportable ? $report->reportable->title : '[Deleted Content]' }}
                                        @else
                                            Reply in: {{ $report->reportable && $report->reportable->thread ? $report->reportable->thread->title : '[Deleted Content]' }}
                                        @endif
                                    </h3>
                                    
                                    @if($report->description)
                                        <div class="mt-2 p-3 bg-gray-800 rounded-md text-gray-300 text-sm">
                                            <strong class="text-white">Report Description:</strong><br>
                                            {{ $report->description }}
                                        </div>
                                    @endif
                                    
                                    @if($report->admin_notes)
                                        <div class="mt-3 p-3 bg-gray-800 rounded-md text-gray-300 text-sm">
                                            <strong class="text-white">Admin Notes:</strong><br>
                                            {{ $report->admin_notes }}
                                        </div>
                                    @endif
                                    
                                    <div class="mt-3 text-sm text-gray-400">
                                        <span>Handled by: {{ $report->reviewer->name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <!-- Pagination -->
                <div class="mt-6">
                    {{ $resolvedReports->links() }}
                </div>
            @else
                <div class="bg-gray-700 rounded-lg p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-gray-300 text-lg">No resolved reports found.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- JavaScript for Tab Switching -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listeners to the tab buttons
        document.getElementById('pending-tab').addEventListener('click', function() {
            showTab('pending');
        });
        
        document.getElementById('resolved-tab').addEventListener('click', function() {
            showTab('resolved');
        });
        
        // Function to switch tabs
        function showTab(tabName) {
            // Hide all content
            document.getElementById('pending-content').classList.add('hidden');
            document.getElementById('resolved-content').classList.add('hidden');
            
            // Remove active class from all tabs
            document.getElementById('pending-tab').classList.remove('border-[#B9FF66]');
            document.getElementById('pending-tab').classList.add('border-transparent');
            document.getElementById('pending-tab').classList.remove('text-white');
            document.getElementById('pending-tab').classList.add('text-gray-400');
            
            document.getElementById('resolved-tab').classList.remove('border-[#B9FF66]');
            document.getElementById('resolved-tab').classList.add('border-transparent');
            document.getElementById('resolved-tab').classList.remove('text-white');
            document.getElementById('resolved-tab').classList.add('text-gray-400');
            
            // Show selected content and activate tab
            document.getElementById(tabName + '-content').classList.remove('hidden');
            document.getElementById(tabName + '-tab').classList.remove('border-transparent');
            document.getElementById(tabName + '-tab').classList.add('border-[#B9FF66]');
            document.getElementById(tabName + '-tab').classList.remove('text-gray-400');
            document.getElementById(tabName + '-tab').classList.add('text-white');
        }
    });
</script>

@endsection
