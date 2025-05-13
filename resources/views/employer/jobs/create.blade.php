{{-- resources/views/employer/jobs/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="px-6 py-8 bg-gray-900 text-gray-300 min-h-screen">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-100">Post a New Job</h1>
        <a href="{{ route('employer.jobs.index') }}" class="text-gray-400 hover:text-gray-100 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Jobs
        </a>
    </div>
    
    @if(session('error'))
    <div class="bg-red-900 border-l-4 border-red-600 text-red-200 p-4 mb-6" role="alert">
        <p>{{ session('error') }}</p>
    </div>
    @endif
    
    <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 overflow-hidden">
        <form action="{{ route('employer.jobs.store') }}" method="POST">
            @csrf
            
            <div class="p-6">
                <!-- Job Title -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Job Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" 
                        class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-black focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent">
                    @error('title')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Job Category -->
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-300 mb-1">Category</label>
                    <select id="category" name="category" 
                        class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-black focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent">
                        <option value="">Select a category</option>
                        <option value="Technology" {{ old('category') == 'Technology' ? 'selected' : '' }}>Technology</option>
                        <option value="Design" {{ old('category') == 'Design' ? 'selected' : '' }}>Design</option>
                        <option value="Marketing" {{ old('category') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                        <option value="Sales" {{ old('category') == 'Sales' ? 'selected' : '' }}>Sales</option>
                        <option value="Customer Service" {{ old('category') == 'Customer Service' ? 'selected' : '' }}>Customer Service</option>
                        <option value="Finance" {{ old('category') == 'Finance' ? 'selected' : '' }}>Finance</option>
                        <option value="Healthcare" {{ old('category') == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                        <option value="Education" {{ old('category') == 'Education' ? 'selected' : '' }}>Education</option>
                        <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('category')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-300 mb-1">Location</label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}" 
                            class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-black focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent">
                        @error('location')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Salary -->
                    <div>
                        <label for="salary" class="block text-sm font-medium text-gray-300 mb-1">Salary (Optional)</label>
                        <input type="text" id="salary" name="salary" value="{{ old('salary') }}" 
                            class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-black focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent" placeholder="e.g., $50,000 - $70,000 or Competitive">
                        @error('salary')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Position Type -->
                    <div>
                        <label for="position_type" class="block text-sm font-medium text-gray-300 mb-1">Position Type</label>
                        <select id="position_type" name="position_type" 
                            class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-black focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent">
                            <option value="">Select position type</option>
                            <option value="Full-time" {{ old('position_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ old('position_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Contract" {{ old('position_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="Internship" {{ old('position_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                            <option value="Temporary" {{ old('position_type') == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                        </select>
                        @error('position_type')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Job Type -->
                    <div>
                        <label for="job_type" class="block text-sm font-medium text-gray-300 mb-1">Job Type</label>
                        <select id="job_type" name="job_type" 
                            class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-black focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent">
                            <option value="">Select job type</option>
                            <option value="Remote" {{ old('job_type') == 'Remote' ? 'selected' : '' }}>Remote</option>
                            <option value="On-site" {{ old('job_type') == 'On-site' ? 'selected' : '' }}>On-site</option>
                            <option value="Hybrid" {{ old('job_type') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                        @error('job_type')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Job Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Job Description</label>
                    <textarea id="description" name="description" rows="8" 
                        class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-black focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Job Status -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Job Status</label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="status" value="active" {{ old('status', 'active') == 'active' ? 'checked' : '' }} class="form-radio text-[#B9FF66] bg-gray-700 border-gray-600 focus:ring-[#B9FF66] focus:ring-offset-gray-800">
                            <span class="ml-2 text-gray-300">Active</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="status" value="draft" {{ old('status') == 'draft' ? 'checked' : '' }} class="form-radio text-[#B9FF66] bg-gray-700 border-gray-600 focus:ring-[#B9FF66] focus:ring-offset-gray-800">
                            <span class="ml-2 text-gray-300">Save as Draft</span>
                        </label>
                    </div>
                    @error('status')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="bg-[#B9FF66] hover:bg-[#a7e55c] text-gray-900 px-6 py-2 rounded-lg text-sm font-medium shadow-sm transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-[#B9FF66]">
                        Post Job
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
