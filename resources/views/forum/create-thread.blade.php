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
                <a href="{{ route('forum.category', $category->slug) }}" class="hover:text-[#B9FF66] transition-colors">{{ $category->name }}</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-white">Create Thread</span>
            </div>
        </div>
        
        <!-- Form Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-white">Create New Thread</h1>
            <p class="text-gray-300 mt-1">in {{ $category->name }}</p>
        </div>
        
        <!-- Thread Form -->
        <form action="{{ route('forum.store-thread', $category->slug) }}" method="POST">
            @csrf
            
            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-white font-medium mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                       class="w-full bg-gray-700 text-white border border-gray-600 rounded-md p-3 focus:border-[#B9FF66] focus:ring focus:ring-[#B9FF66] focus:ring-opacity-50"
                       placeholder="Enter a descriptive title for your thread" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Content -->
            <div class="mb-4">
                <label for="content" class="block text-white font-medium mb-2">Content</label>
                <textarea name="content" id="content" rows="10" 
                          class="w-full bg-gray-700 text-white border border-gray-600 rounded-md p-3 focus:border-[#B9FF66] focus:ring focus:ring-[#B9FF66] focus:ring-opacity-50"
                          placeholder="Write your thread content here..." required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Tags -->
            <div class="mb-6">
                <label class="block text-white font-medium mb-2">Tags (Optional)</label>
                <div class="flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                        <label class="inline-flex items-center px-3 py-2 rounded-md" style="background-color: {{ $tag->color }}20; color: {{ $tag->color }};">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                   class="form-checkbox h-4 w-4 mr-2 rounded" 
                                   style="color: {{ $tag->color }};"
                                   {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                            {{ $tag->name }}
                        </label>
                    @endforeach
                </div>
                @error('tags')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Guidelines -->
            <div class="bg-gray-700 rounded-lg p-4 mb-6 border border-gray-600">
                <h3 class="text-white font-medium mb-2">Posting Guidelines</h3>
                <ul class="list-disc list-inside text-gray-300 text-sm space-y-1">
                    <li>Be respectful and considerate of others.</li>
                    <li>Keep discussions relevant to the category topics.</li>
                    <li>Do not spam or post promotional content without permission.</li>
                    <li>Use appropriate tags to help others find your thread.</li>
                    <li>Follow the LokerNow terms of service and community guidelines.</li>
                </ul>
            </div>
            
            <!-- Submit Button -->
            <div class="flex justify-end">
                <a href="{{ route('forum.category', $category->slug) }}" 
                   class="bg-gray-600 hover:bg-gray-500 text-white py-2 px-4 rounded-md mr-2">
                    Cancel
                </a>
                <button type="submit" class="bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-medium py-2 px-4 rounded-md">
                    Create Thread
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
