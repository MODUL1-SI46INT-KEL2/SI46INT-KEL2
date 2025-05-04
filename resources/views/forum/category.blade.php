@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-6 border-l-4 border-[#B9FF66]">
        <!-- Breadcrumb -->
        <div class="mb-4">
            <div class="flex items-center text-gray-400 text-sm">
                <a href="{{ route('forum.index') }}" class="hover:text-[#B9FF66] transition-colors">Forum</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-white">{{ $category->name }}</span>
            </div>
        </div>
        
        <!-- Category Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div class="flex items-center">
                <!-- Category Icon -->
                <div class="flex-shrink-0 mr-4">
                    @if($category->slug == 'jobseeker-discussion')
                        <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    @elseif($category->slug == 'employer-company-discussion')
                        <div class="w-12 h-12 rounded-full bg-green-500 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    @else
                        <div class="w-12 h-12 rounded-full bg-purple-500 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    @endif
                </div>
                
                <!-- Category Info -->
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ $category->name }}</h1>
                    <p class="text-gray-300 mt-1">{{ $category->description }}</p>
                    <div class="flex items-center mt-2 space-x-4 text-sm">
                        <span class="flex items-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            {{ $threads->total() }} threads
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- New Thread Button -->
            <a href="{{ route('forum.create-thread', $category->slug) }}" 
               class="bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-medium py-2 px-4 rounded-md inline-flex items-center transition-transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                New Thread
            </a>
        </div>
    </div>
    
    <!-- Threads List -->
    @if(count($threads) > 0)
        <div class="space-y-4 mb-6">
            @foreach($threads as $thread)
                <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-700 hover:border-[#B9FF66] transition-all transform hover:-translate-y-1 hover:shadow-lg">
                    <div class="p-5">
                        <div class="flex items-start">
                            <!-- Thread Status Indicators -->
                            <div class="mr-4 flex flex-col items-center space-y-2">
                                @if($thread->is_pinned)
                                    <div class="bg-yellow-500 p-2 rounded-full" title="Pinned Thread">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </div>
                                @endif
                                
                                @if($thread->is_locked)
                                    <div class="bg-red-500 p-2 rounded-full" title="Locked Thread">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Thread Content -->
                            <div class="flex-1">
                                <!-- Thread Title -->
                                <div class="mb-2">
                                    <a href="{{ route('forum.thread', ['categorySlug' => $category->slug, 'threadSlug' => $thread->slug]) }}" 
                                       class="text-xl font-bold text-white hover:text-[#B9FF66] transition-colors">
                                        {{ $thread->title }}
                                    </a>
                                </div>
                                
                                <!-- Thread Tags -->
                                @if($thread->tags->count() > 0)
                                    <div class="flex flex-wrap gap-2 mb-3">
                                        @foreach($thread->tags as $tag)
                                            <span class="px-2 py-1 text-xs font-medium rounded-full" style="background-color: {{ $tag->color }}20; color: {{ $tag->color }};">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                                
                                <!-- Thread Meta -->
                                <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-gray-400">
                                    <!-- Author -->
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span>{{ $thread->user->name }}</span>
                                    </div>
                                    
                                    <!-- Date -->
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ $thread->created_at->format('M d, Y') }}</span>
                                    </div>
                                    
                                    <!-- Replies -->
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                        </svg>
                                        <span>{{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}</span>
                                    </div>
                                    
                                    <!-- Views -->
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span>{{ $thread->view_count }} {{ Str::plural('view', $thread->view_count) }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Thread Action -->
                            <div class="hidden md:flex ml-4 self-center">
                                <a href="{{ route('forum.thread', ['categorySlug' => $category->slug, 'threadSlug' => $thread->slug]) }}" 
                                   class="text-[#B9FF66] hover:bg-gray-700 p-2 rounded-full transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-6">
            {{ $threads->links() }}
        </div>
    @else
        <div class="bg-gray-800 rounded-lg p-8 text-center border border-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <h3 class="text-xl font-bold text-white mb-2">No Threads Yet</h3>
            <p class="text-gray-400 text-lg mb-6">Be the first to start a discussion in this category!</p>
            <a href="{{ route('forum.create-thread', $category->slug) }}" 
               class="bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-medium py-3 px-6 rounded-md inline-flex items-center transition-transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Start a New Thread
            </a>
        </div>
    @endif
</div>
@endsection
