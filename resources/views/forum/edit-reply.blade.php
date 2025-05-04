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
                <a href="{{ route('forum.category', $reply->thread->category->slug) }}" class="hover:text-[#B9FF66] transition-colors">{{ $reply->thread->category->name }}</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('forum.thread', ['categorySlug' => $reply->thread->category->slug, 'threadSlug' => $reply->thread->slug]) }}" class="hover:text-[#B9FF66] transition-colors truncate max-w-xs">{{ $reply->thread->title }}</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-white">Edit Reply</span>
            </div>
        </div>
        
        <!-- Form Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-white">Edit Reply</h1>
            <p class="text-gray-300 mt-1">in thread: {{ $reply->thread->title }}</p>
        </div>
        
        <!-- Reply Form -->
        <form action="{{ route('forum.update-reply', $reply->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Content -->
            <div class="mb-6">
                <label for="content" class="block text-white font-medium mb-2">Content</label>
                <textarea name="content" id="content" rows="8" 
                          class="w-full bg-gray-700 text-white border border-gray-600 rounded-md p-3 focus:border-[#B9FF66] focus:ring focus:ring-[#B9FF66] focus:ring-opacity-50"
                          required>{{ old('content', $reply->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Guidelines -->
            <div class="bg-gray-700 rounded-lg p-4 mb-6 border border-gray-600">
                <h3 class="text-white font-medium mb-2">Editing Guidelines</h3>
                <ul class="list-disc list-inside text-gray-300 text-sm space-y-1">
                    <li>Be respectful and considerate of others.</li>
                    <li>Keep discussions relevant to the thread topic.</li>
                    <li>Do not spam or post promotional content without permission.</li>
                    <li>Follow the LokerNow terms of service and community guidelines.</li>
                </ul>
            </div>
            
            <!-- Submit Button -->
            <div class="flex justify-end">
                <a href="{{ route('forum.thread', ['categorySlug' => $reply->thread->category->slug, 'threadSlug' => $reply->thread->slug]) }}" 
                   class="bg-gray-600 hover:bg-gray-500 text-white py-2 px-4 rounded-md mr-2">
                    Cancel
                </a>
                <button type="submit" class="bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-medium py-2 px-4 rounded-md">
                    Update Reply
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
