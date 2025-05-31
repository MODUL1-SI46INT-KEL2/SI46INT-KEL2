@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
        <div class="mb-6">
            <a href="{{ url()->previous() }}" class="inline-flex items-center text-[#B9FF66] hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back
            </a>
        </div>
        
        <h1 class="text-2xl font-bold text-white mb-6">Write a Review for {{ $companyName }}</h1>
        
        <div class="mb-8 p-4 bg-gray-700 rounded-lg">
            <h2 class="text-lg font-medium text-white mb-2">Review Guidelines</h2>
            <ul class="list-disc list-inside text-gray-300 space-y-1 text-sm">
                <li>Be honest and specific about your experience</li>
                <li>Focus on your work experience and company culture</li>
                <li>Avoid mentioning individuals by name</li>
                <li>Do not include confidential information</li>
                <li>Your review will be moderated before being published</li>
            </ul>
        </div>
        
        <form action="{{ route('reviews.store') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="admin_id" value="{{ $employer->id }}">
            
            <!-- Rating -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-3">Rating <span class="text-red-500">*</span></label>
                <div class="flex space-x-1" x-data="{ rating: 0 }">
                    @for($i = 1; $i <= 5; $i++)
                        <button 
                            type="button" 
                            @click="rating = {{ $i }}; document.getElementById('rating-input').value = {{ $i }}"
                            class="focus:outline-none"
                            :class="{ 'scale-110 transform transition-transform': rating >= {{ $i }} }"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" :class="rating >= {{ $i }} ? 'text-[#B9FF66]' : 'text-gray-500'" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </button>
                    @endfor
                    <input type="hidden" name="rating" id="rating-input" value="{{ old('rating', 0) }}" required>
                </div>
                @error('rating')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Job Title -->
            <div>
                <label for="job_title" class="block text-sm font-medium text-gray-300 mb-1">Job Title</label>
                <input type="text" name="job_title" id="job_title" value="{{ old('job_title') }}" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent">
                @error('job_title')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Employment Period -->
            <div>
                <label for="employment_period" class="block text-sm font-medium text-gray-300 mb-1">Employment Period</label>
                <input type="text" name="employment_period" id="employment_period" value="{{ old('employment_period') }}" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent" placeholder="e.g. June 2022 - Present">
                @error('employment_period')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Review Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-300 mb-1">Review <span class="text-red-500">*</span></label>
                <textarea name="content" id="content" rows="6" required class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent" placeholder="Share your experience working for this employer...">{{ old('content') }}</textarea>
                <p class="mt-1 text-xs text-gray-400">Minimum 10 characters, maximum 1000 characters.</p>
                @error('content')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Anonymous Review -->
            <div class="flex items-center">
                <input type="checkbox" name="anonymous" id="anonymous" class="h-4 w-4 text-[#B9FF66] focus:ring-[#B9FF66] bg-gray-700 border-gray-600 rounded" {{ old('anonymous') ? 'checked' : '' }}>
                <label for="anonymous" class="ml-2 block text-sm text-gray-300">
                    Post this review anonymously
                </label>
            </div>
            
            <div class="pt-4">
                <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-medium rounded-lg shadow-md transition-colors">
                    Submit Review
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
