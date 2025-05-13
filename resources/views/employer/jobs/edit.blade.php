{{-- resources/views/employer/jobs/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="px-6 py-8 bg-gray-900 text-white min-h-screen">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-white">Edit Job</h1>
        <a href="{{ route('employer.jobs.index') }}" class="text-gray-300 hover:text-white transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Jobs
        </a>
    </div>
    
    @if(session('success'))
    <div class="bg-green-900 border-l-4 border-green-500 text-green-300 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif
    
    @if(session('error'))
    <div class="bg-red-900 border-l-4 border-red-500 text-red-300 p-4 mb-6" role="alert">
        <p>{{ session('error') }}</p>
    </div>
    @endif
    
    <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 overflow-hidden">
        <form action="{{ route('employer.jobs.update', $job->id_job) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="p-6">
                <!-- Job Title -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Job Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $job->title) }}" 
                        class="w-full px-4 py-2 bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66] placeholder-gray-500">
                    @error('title')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Job Category -->
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-300 mb-1">Category</label>
                    <select id="category" name="category" 
                        class="w-full px-4 py-2 bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                        <option value="">Select a category</option>
                        <option value="Technology" {{ old('category', $job->category) == 'Technology' ? 'selected' : '' }}>Technology</option>
                        <option value="Design" {{ old('category', $job->category) == 'Design' ? 'selected' : '' }}>Design</option>
                        <option value="Marketing" {{ old('category', $job->category) == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                        <option value="Sales" {{ old('category', $job->category) == 'Sales' ? 'selected' : '' }}>Sales</option>
                        <option value="Customer Service" {{ old('category', $job->category) == 'Customer Service' ? 'selected' : '' }}>Customer Service</option>
                        <option value="Finance" {{ old('category', $job->category) == 'Finance' ? 'selected' : '' }}>Finance</option>
                        <option value="Healthcare" {{ old('category', $job->category) == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                        <option value="Education" {{ old('category', $job->category) == 'Education' ? 'selected' : '' }}>Education</option>
                        <option value="Other" {{ old('category', $job->category) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('category')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-300 mb-1">Location</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $job->location) }}" 
                            class="w-full px-4 py-2 bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66] placeholder-gray-500">
                        @error('location')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Salary -->
                    <div>
                        <label for="salary" class="block text-sm font-medium text-gray-300 mb-1">Salary</label>
                        <input type="number" id="salary" name="salary" value="{{ old('salary', $job->salary) }}" step="0.01" min="0"
                            class="w-full px-4 py-2 bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66] placeholder-gray-500">
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
                            class="w-full px-4 py-2 bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                            <option value="">Select position type</option>
                            <option value="Full-time" {{ old('position_type', $job->position_type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ old('position_type', $job->position_type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Contract" {{ old('position_type', $job->position_type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="Internship" {{ old('position_type', $job->position_type) == 'Internship' ? 'selected' : '' }}>Internship</option>
                            <option value="Temporary" {{ old('position_type', $job->position_type) == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                        </select>
                        @error('position_type')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Job Type -->
                    <div>
                        <label for="job_type" class="block text-sm font-medium text-gray-300 mb-1">Job Type</label>
                        <select id="job_type" name="job_type" 
                            class="w-full px-4 py-2 bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                            <option value="">Select job type</option>
                            <option value="Remote" {{ old('job_type', $job->job_type) == 'Remote' ? 'selected' : '' }}>Remote</option>
                            <option value="On-site" {{ old('job_type', $job->job_type) == 'On-site' ? 'selected' : '' }}>On-site</option>
                            <option value="Hybrid" {{ old('job_type', $job->job_type) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
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
                        class="w-full px-4 py-2 bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66] placeholder-gray-500">{{ old('description', $job->description) }}</textarea>
                    @error('description')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Job Status -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Job Status</label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center text-gray-300">
                            <input type="radio" name="status" value="active" {{ old('status', $job->status) == 'active' ? 'checked' : '' }} class="form-radio text-[#B9FF66] border-gray-600 bg-gray-700">
                            <span class="ml-2">Active</span>
                        </label>
                        <label class="inline-flex items-center text-gray-300">
                            <input type="radio" name="status" value="draft" {{ old('status', $job->status) == 'draft' ? 'checked' : '' }} class="form-radio text-[#B9FF66] border-gray-600 bg-gray-700">
                            <span class="ml-2">Draft</span>
                        </label>
                        <label class="inline-flex items-center text-gray-300">
                            <input type="radio" name="status" value="closed" {{ old('status', $job->status) == 'closed' ? 'checked' : '' }} class="form-radio text-[#B9FF66] border-gray-600 bg-gray-700">
                            <span class="ml-2">Closed</span>
                        </label>
                    </div>
                    @error('status')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Submit Button -->
                <div class="mt-6 flex items-center justify-between">
                    <button type="submit" class="bg-[#B9FF66] hover:bg-[#a7e55c] px-6 py-2 rounded-lg text-sm font-medium text-gray-900 shadow-sm transition duration-200">
                        Update Job
                    </button>
                    
                    <form action="{{ route('employer.jobs.destroy', $job->id_job) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this job?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-900 text-red-300 hover:bg-red-800 hover:text-red-200 px-6 py-2 rounded-lg text-sm font-medium shadow-sm transition duration-200">
                            Delete Job
                        </button>
                    </form>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
