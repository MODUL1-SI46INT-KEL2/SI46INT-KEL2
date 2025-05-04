@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-8 border-l-4 border-[#B9FF66]">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Open Forum</h1>
                <p class="text-gray-300">
                    Welcome to the LokerNow Open Forum! This is a place for job seekers and employers to discuss topics related to employment, careers, and professional development.
                </p>
            </div>
            <div class="hidden md:block">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                </svg>
            </div>
        </div>
    </div>
    
    <!-- Categories Section -->
    <div class="grid grid-cols-1 gap-6 mb-8">
        @foreach($categories as $category)
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg border border-gray-700 hover:border-[#B9FF66] transition-all transform hover:-translate-y-1 hover:shadow-xl">
                <div class="p-6">
                    <!-- Category Header -->
                    <div class="flex items-center mb-4">
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
                        <div>
                            <a href="{{ route('forum.category', $category->slug) }}" class="text-2xl font-bold text-white hover:text-[#B9FF66] transition-colors">
                                {{ $category->name }}
                            </a>
                            <div class="flex items-center mt-1 space-x-4 text-sm">
                                <span class="flex items-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    {{ $category->threads_count }} threads
                                </span>
                                <span class="flex items-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                    </svg>
                                    {{ $category->replies_count }} replies
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Category Description -->
                    <p class="text-gray-300 mb-4">{{ $category->description }}</p>
                    
                    <!-- Latest Thread -->
                    @if($category->latest_thread)
                        <div class="mt-4 pt-4 border-t border-gray-700 bg-gray-700 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <span class="text-[#B9FF66] font-medium">Latest Thread</span>
                            </div>
                            <a href="{{ route('forum.thread', ['categorySlug' => $category->slug, 'threadSlug' => $category->latest_thread->slug]) }}" 
                               class="text-white hover:text-[#B9FF66] font-medium transition-colors block mb-2">
                                {{ $category->latest_thread->title }}
                            </a>
                            <div class="flex items-center text-sm text-gray-400">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ $category->latest_thread->user->name }}
                                </span>
                                <span class="mx-2">•</span>
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $category->latest_thread->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="mt-4 pt-4 border-t border-gray-700 bg-gray-700 rounded-lg p-4 text-center">
                            <p class="text-gray-400">No threads yet. Be the first to start a discussion!</p>
                            <a href="{{ route('forum.create-thread', $category->slug) }}" class="mt-2 inline-block bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-medium py-2 px-4 rounded-md">
                                Start a Thread
                            </a>
                        </div>
                    @endif
                    
                    <!-- View Category Button -->
                    <div class="mt-4 text-right">
                        <a href="{{ route('forum.category', $category->slug) }}" class="inline-flex items-center text-[#B9FF66] hover:underline">
                            View Category
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Forum Guidelines -->
    <div class="bg-gray-800 rounded-lg shadow-lg p-6 border-l-4 border-yellow-500">
        <div class="flex items-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h2 class="text-xl font-bold text-white">Forum Guidelines</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <ul class="space-y-2">
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-300">Be respectful and considerate of others.</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-300">Keep discussions relevant to the category topics.</span>
                    </li>
                </ul>
            </div>
            <div>
                <ul class="space-y-2">
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-300">Do not spam or post promotional content without permission.</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-300">Report any inappropriate content using the report button.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
