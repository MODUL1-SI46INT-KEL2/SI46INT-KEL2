@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 md:px-8 lg:px-12 py-10 max-w-6xl">
    <!-- Thread Header Section -->
    <div class="bg-gray-800 rounded-lg shadow-lg p-6 md:p-8 mb-8 border-l-4 border-[#B9FF66]">
        <!-- Breadcrumb Navigation -->
        <div class="mb-4">
            <div class="flex items-center text-gray-400 text-sm">
                <a href="{{ route('forum.index') }}" class="hover:text-[#B9FF66] transition-colors">Forum</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('forum.category', $thread->category->slug) }}" class="hover:text-[#B9FF66] transition-colors">{{ $thread->category->name }}</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-white truncate max-w-xs">{{ $thread->title }}</span>
            </div>
        </div>
        
        <!-- Thread Status Badges -->
        <div class="flex flex-wrap gap-2 mb-4">
            @if($thread->is_pinned)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-900/70 text-yellow-200 border border-yellow-700 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Pinned
                </span>
            @endif
            
            @if($thread->is_locked)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-900/70 text-red-200 border border-red-700 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Locked
                </span>
            @endif
            
            <!-- Thread Tags -->
            @if($thread->tags->count() > 0)
                @foreach($thread->tags as $tag)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium shadow-sm border" 
                          style="background-color: {{ $tag->color }}20; color: {{ $tag->color }}; border-color: {{ $tag->color }}40;">
                        {{ $tag->name }}
                    </span>
                @endforeach
            @endif
        </div>
        
        <!-- Thread Title & Actions -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
            <h1 class="text-2xl md:text-3xl font-bold text-white">{{ $thread->title }}</h1>
            
            <!-- Thread Actions Dropdown -->
            @auth
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="bg-gray-700 hover:bg-gray-600 text-gray-300 px-3 py-2 rounded-md inline-flex items-center text-sm transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                        Thread Actions
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-56 bg-gray-700 rounded-md shadow-lg z-10 border border-gray-600 overflow-hidden">
                        <div class="py-1">
                            @if(auth()->user()->id !== $thread->user_id)
                                <a href="#" onclick="event.preventDefault(); document.getElementById('report-thread-form').submit();" 
                                   class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-600 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    Report Thread
                                </a>
                                <form id="report-thread-form" action="{{ route('forum.report') }}" method="POST" class="hidden">
                                    @csrf
                                    <input type="hidden" name="reportable_type" value="thread">
                                    <input type="hidden" name="reportable_id" value="{{ $thread->id }}">
                                </form>
                            @endif
                            
                            @if(auth()->user()->id === $thread->user_id || auth()->user()->hasRole(['admin', 'moderator']))
                                @if(!$thread->is_locked)
                                    <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-600 hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit Thread
                                    </a>
                                @endif
                                
                                @if(auth()->user()->hasRole(['admin', 'moderator']))
                                    <div class="border-t border-gray-600 my-1"></div>
                                    
                                    @if($thread->is_pinned)
                                        <a href="{{ route('forum.moderation.unpin', $thread->id) }}" 
                                           class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-600 hover:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Unpin Thread
                                        </a>
                                    @else
                                        <a href="{{ route('forum.moderation.pin', $thread->id) }}" 
                                           class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-600 hover:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Pin Thread
                                        </a>
                                    @endif
                                    
                                    @if($thread->is_locked)
                                        <a href="{{ route('forum.moderation.unlock', $thread->id) }}" 
                                           class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-600 hover:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                            </svg>
                                            Unlock Thread
                                        </a>
                                    @else
                                        <a href="{{ route('forum.moderation.lock', $thread->id) }}" 
                                           class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-600 hover:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                            Lock Thread
                                        </a>
                                    @endif
                                    
                                    <div class="border-t border-gray-600 my-1"></div>
                                    
                                    <a href="{{ route('forum.moderation.delete-thread', $thread->id) }}" 
                                       onclick="return confirm('Are you sure you want to delete this thread? This action cannot be undone.')" 
                                       class="flex items-center px-4 py-2 text-sm text-red-400 hover:bg-gray-600 hover:text-red-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete Thread
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endauth
        </div>
        
        <!-- Thread Meta Information -->
        <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-gray-400 mb-6">
            <!-- Author -->
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>{{ $thread->user->name }}</span>
                <span class="ml-1 px-1.5 py-0.5 text-xs rounded bg-gray-700">{{ ucfirst($thread->user->role) }}</span>
            </div>
            
            <!-- Date -->
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>{{ $thread->created_at->format('M d, Y \a\t h:i A') }}</span>
            </div>
            
            <!-- Views -->
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <span>{{ $thread->view_count }} {{ Str::plural('view', $thread->view_count) }}</span>
            </div>
            
            <!-- Replies -->
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                </svg>
                <span>{{ $thread->replies->count() }} {{ Str::plural('reply', $thread->replies->count()) }}</span>
            </div>
        </div>
        
        <!-- Thread Content -->
        <div class="bg-gray-700 rounded-lg p-6 border border-gray-600">
            <div class="flex">
                <!-- Author Avatar -->
                <div class="mr-4 flex-shrink-0">
                    <div class="w-12 h-12 bg-[#B9FF66] rounded-full flex items-center justify-center text-xl font-bold text-gray-900">
                        {{ strtoupper(substr($thread->user->name, 0, 1)) }}
                    </div>
                </div>
                
                <!-- Thread Content -->
                <div class="flex-1">
                    <div class="prose prose-invert max-w-none">
                        {!! nl2br(e($thread->content)) !!}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Replies Section -->
        <div class="mt-8">
            <!-- Replies Header -->
            <div class="flex justify-between items-center mb-6 border-b border-gray-700 pb-3">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                    </svg>
                    <h2 class="text-xl font-semibold text-white">{{ $thread->replies->count() }} {{ Str::plural('Reply', $thread->replies->count()) }}</h2>
                </div>
                
                @if($thread->is_locked)
                    <div class="bg-red-900 text-red-300 py-1.5 px-3 rounded-full inline-flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Thread Locked
                    </div>
                @endif
            </div>
            
            <!-- Replies List -->
            <div class="space-y-12">
                @forelse($replies as $reply)
                    <div id="reply-{{ $reply->id }}"                          class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden transition-all hover:border-gray-600 @if($reply->parent_id) ml-0 md:ml-16 @endif">
                        <!-- Reply Header -->
                        <div class="bg-gray-800 p-4 md:p-5 border-b border-gray-700 flex justify-between items-center">
                            <div class="flex items-center">
                                <!-- Author Avatar -->
                                <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-white font-medium mr-3">
                                    {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                                </div>
                                
                                <!-- Author Info -->
                                <div>
                                    <div class="text-white text-sm font-medium">{{ $reply->user->name }}</div>
                                    <div class="text-xs text-gray-400 flex items-center">
                                        <span class="mr-2">{{ ucfirst($reply->user->role) }}</span>
                                        <span class="text-gray-500">•</span>
                                        <span class="ml-2">{{ $reply->created_at->format('M d, Y \a\t h:i A') }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Reply Actions Dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="text-gray-400 hover:text-white p-1 rounded-full hover:bg-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                    </svg>
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-gray-700 rounded-md shadow-lg z-10 border border-gray-600 overflow-hidden">
                                    <div class="py-1">
                                        @if(!$thread->is_locked && auth()->check())
                                            <button type="button" onclick="toggleReplyForm({{ $reply->id }}); open = false;" 
                                                    class="flex items-center w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-600 hover:text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                                </svg>
                                                Reply
                                            </button>
                                        @endif
                                        
                                        @if(auth()->check() && (auth()->id() === $reply->user_id || auth()->user()->hasRole(['admin', 'moderator'])))
                                            @if(!$thread->is_locked)
                                                <a href="{{ route('forum.edit-reply', $reply->id) }}" 
                                                   class="flex items-center w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-600 hover:text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit Reply
                                                </a>
                                            @endif
                                            
                                            <form action="{{ route('forum.delete-reply', $reply->id) }}" method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this reply? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-600 hover:text-red-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Delete Reply
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if(auth()->check() && auth()->id() !== $reply->user_id)
                                            <button type="button" onclick="toggleReportForm('reply', {{ $reply->id }}); open = false;" 
                                                    class="flex items-center w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-600 hover:text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                                Report Reply
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Reply Content -->
                        <div class="p-6 md:p-7">
                            <div class="mt-4 text-gray-300 prose prose-sm prose-invert max-w-none">
                                {!! nl2br(e($reply->content)) !!}
                            </div>
                            
                            <!-- Direct Report Button -->
                            @if(auth()->check() && auth()->id() !== $reply->user_id)
                            <div class="mt-4 text-right">
                                <button type="button" onclick="toggleReportForm('reply', {{ $reply->id }})" class="text-gray-400 hover:text-gray-300 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2v3M4 7h16" />
                                    </svg>
                                    Report
                                </button>
                            </div>
                            @endif
                            
                            <!-- Nested Reply Form (Hidden by Default) -->
                            <div id="reply-form-{{ $reply->id }}" class="mt-6 hidden border-t border-gray-700 pt-4">
                                <form action="{{ route('forum.store-reply', $thread->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $reply->id }}">
                                    <div class="mb-3">
                                        <label for="reply-content-{{ $reply->id }}" class="block text-sm font-medium text-gray-400 mb-1">Your Reply</label>
                                        <textarea id="reply-content-{{ $reply->id }}" name="content" rows="3" 
                                                  class="w-full bg-gray-700 text-white border border-gray-600 rounded-md p-3 focus:border-[#B9FF66] focus:ring focus:ring-[#B9FF66] focus:ring-opacity-50" 
                                                  placeholder="Write your reply..."></textarea>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="button" onclick="toggleReplyForm({{ $reply->id }})" 
                                                class="bg-gray-700 hover:bg-gray-600 text-white py-2 px-4 rounded-md mr-2 transition-colors">
                                            Cancel
                                        </button>
                                        <button type="submit" 
                                                class="bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-medium py-2 px-4 rounded-md transition-colors">
                                            Post Reply
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-gray-800 rounded-lg p-8 md:p-10 border border-gray-700 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <p class="text-gray-400 text-lg mb-2">No replies yet</p>
                        <p class="text-gray-500">Be the first to join the conversation!</p>
                    </div>
                @endforelse

                <!-- Child Replies Section -->
                @if(isset($childReplies) && $childReplies->count() > 0)
                    @foreach($childReplies as $childReply)
                        <div class="mt-8 bg-gray-800 rounded-lg p-5 md:p-6 border border-gray-700">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-white font-medium mr-3">
                                    {{ strtoupper(substr($childReply->user->name, 0, 1)) }}
                                </div>
                                <div class="mt-2 text-white text-sm font-medium">{{ $childReply->user->name }}</div>
                                <div class="text-xs text-gray-400">{{ ucfirst($childReply->user->role) }}</div>
                            </div>
                            
                            <!-- Content -->
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div class="text-xs text-gray-400">
                                        {{ $childReply->created_at->format('M d, Y \a\t h:i A') }}
                                    </div>
                                    
                                    <!-- Reply Actions -->
                                    <div class="flex space-x-2">
                                        @if(auth()->check() && (auth()->id() === $childReply->user_id || auth()->user()->hasRole(['admin', 'moderator'])))
                                            <a href="{{ route('forum.edit-reply', $childReply->id) }}" class="text-gray-400 hover:text-gray-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            
                                            <form action="{{ route('forum.delete-reply', $childReply->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reply?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                
                                
                                <div class="prose prose-invert max-w-none mt-2">
                                    {!! nl2br(e($childReply->content)) !!}
                                </div>
                                
                                <!-- Report Button -->
                                <div class="mt-4 text-right">
                                    <button type="button" onclick="toggleReportForm('reply', {{ $childReply->id }})" class="text-gray-400 hover:text-gray-300 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2v3M4 7h16" />
                                        </svg>
                                        Report
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                
                @if(!isset($replies) || $replies->count() == 0)
                <div class="bg-gray-800 rounded-lg p-8 md:p-10 border border-gray-700 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <p class="text-gray-400 text-lg mb-2">No replies yet</p>
                    <p class="text-gray-500">Be the first to join the conversation!</p>
                </div>
                @endif
        </div>
        
        
        <!-- Pagination -->
        @if($replies->hasPages())
            <div class="mt-6">
                {{ $replies->links() }}
            </div>
        @endif
        
        <!-- Reply Form -->
        @if(!$thread->is_locked && auth()->check())
            <div class="mt-6 pt-6 border-t border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4">Post a Reply</h3>
                <form action="{{ route('forum.store-reply', $thread->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <textarea name="content" rows="5" class="w-full bg-gray-700 text-white border border-gray-600 rounded-md p-4 focus:border-[#B9FF66] focus:ring focus:ring-[#B9FF66] focus:ring-opacity-50" placeholder="Write your reply..."></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-medium py-2 px-4 rounded-md">
                            Post Reply
                        </button>
                    </div>
                </form>
            </div>
        @elseif($thread->is_locked)
            <div class="mt-6 pt-6 border-t border-gray-700 text-center">
                <div class="bg-gray-700 rounded-lg p-6 border border-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-gray-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <p class="text-gray-300">This thread is locked. No new replies can be posted.</p>
                </div>
            </div>
        @else
            <div class="mt-6 pt-6 border-t border-gray-700 text-center">
                <div class="bg-gray-700 rounded-lg p-6 border border-gray-600">
                    <p class="text-gray-300">Please <a href="{{ route('login') }}" class="text-[#B9FF66] hover:underline">log in</a> to post a reply.</p>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Report Modal (Hidden by Default) -->
<div id="report-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-gray-800 rounded-lg p-6 max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-white">Report Content</h3>
            <button type="button" onclick="closeReportModal()" class="text-gray-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <form id="report-form" action="{{ route('forum.report') }}" method="POST">
            @csrf
            <input type="hidden" id="reportable-type" name="reportable_type" value="">
            <input type="hidden" id="reportable-id" name="reportable_id" value="">
            
            <div class="mb-4">
                <label for="reason" class="block text-white mb-1">Reason</label>
                <select id="reason" name="reason" class="w-full bg-gray-700 text-white border border-gray-600 rounded-md p-2 focus:border-[#B9FF66] focus:ring focus:ring-[#B9FF66] focus:ring-opacity-50">
                    <option value="spam">Spam</option>
                    <option value="harassment">Harassment</option>
                    <option value="inappropriate">Inappropriate Content</option>
                    <option value="offensive">Offensive Language</option>
                    <option value="other">Other</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-white mb-1">Description (Optional)</label>
                <textarea id="description" name="description" rows="3" class="w-full bg-gray-700 text-white border border-gray-600 rounded-md p-2 focus:border-[#B9FF66] focus:ring focus:ring-[#B9FF66] focus:ring-opacity-50" placeholder="Please provide additional details..."></textarea>
            </div>
            
            <div class="flex justify-end">
                <button type="button" onclick="closeReportModal()" class="bg-gray-600 hover:bg-gray-500 text-white py-2 px-4 rounded-md mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md">
                    Submit Report
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

<!-- JavaScript for Forum Thread Functionality -->
<script>
    function toggleReplyForm(replyId) {
        const replyForm = document.getElementById(`reply-form-${replyId}`);
        if (replyForm.classList.contains('hidden')) {
            replyForm.classList.remove('hidden');
        } else {
            replyForm.classList.add('hidden');
        }
    }
    
    function toggleReportForm(type, id) {
        const reportModal = document.getElementById('report-modal');
        const reportableType = document.getElementById('reportable-type');
        const reportableId = document.getElementById('reportable-id');
        
        reportableType.value = type;
        reportableId.value = id;
        
        reportModal.classList.remove('hidden');
    }
    
    function closeReportModal() {
        const reportModal = document.getElementById('report-modal');
        reportModal.classList.add('hidden');
    }
</script>
