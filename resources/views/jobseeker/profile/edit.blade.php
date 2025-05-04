{{-- resources/views/jobseeker/profile/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="px-6 py-8 bg-gray-900 text-white min-h-screen">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-white">Jobseeker Profile</h1>
        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Dashboard
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
        <form action="{{ route('jobseeker.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="p-6">
                <!-- Personal Information Section -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-white mb-4">Personal Information</h2>
                    
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                            class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                        @error('name')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Phone -->
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-300 mb-1">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" 
                            class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                        @error('phone')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                                <!-- Professional Information Section -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-white mb-4">Professional Information</h2>
                    
                    <!-- Job Title -->
                    <div class="mb-4">
                        <label for="job_title" class="block text-sm font-medium text-gray-300 mb-1">Job Title</label>
                        <input type="text" id="job_title" name="job_title" value="{{ old('job_title', $profile->job_title) }}" 
                            class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                        <p class="text-gray-400 text-xs mt-1">e.g. Frontend Developer, UX Designer, etc.</p>
                        @error('job_title')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Location -->
                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-300 mb-1">Location</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $profile->location) }}" 
                            class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                        <p class="text-gray-400 text-xs mt-1">e.g. Jakarta, Indonesia or Remote</p>
                        @error('location')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Available for Hire -->
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" id="available_for_hire" name="available_for_hire" value="1" {{ old('available_for_hire', $profile->available_for_hire) ? 'checked' : '' }} 
                            class="h-4 w-4 text-[#B9FF66] focus:ring-[#B9FF66] border-gray-300 rounded">
                        <label for="available_for_hire" class="ml-2 block text-sm text-gray-300">Available for hire</label>
                    </div>
                </div>
                    
                    <!-- Resume Upload Section -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-white mb-4">Resume</h2>
                    
                    <div class="mb-4">
                        <div class="flex items-center mb-2">
                            @if($profile->resume_path)
                                <div class="flex items-center bg-gray-700 text-gray-300 px-3 py-2 rounded-lg mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm">Current Resume</span>
                                </div>
                                <a href="{{ asset('storage/' . $profile->resume_path) }}" target="_blank" class="text-[#B9FF66] text-sm hover:underline">View</a>
                            @else
                                <div class="text-gray-400 text-sm">No resume uploaded yet</div>
                            @endif
                        </div>
                        
                        <label for="resume" class="block text-sm font-medium text-gray-300 mb-1">Upload Resume (PDF, DOC, DOCX)</label>
                        <input type="file" id="resume" name="resume" 
                            class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                        <p class="text-gray-400 text-xs mt-1">Maximum file size: 2MB</p>
                        @error('resume')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Portfolio Upload Section -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-white mb-4">Portfolio</h2>
                    
                    <div class="mb-4">
                        <div class="flex items-center mb-2">
                            @if($profile->portfolio_path)
                                <div class="flex items-center bg-gray-700 text-gray-300 px-3 py-2 rounded-lg mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm">Current Portfolio</span>
                                </div>
                                <a href="{{ asset('storage/' . $profile->portfolio_path) }}" target="_blank" class="text-[#B9FF66] text-sm hover:underline">View</a>
                            @else
                                <div class="text-gray-400 text-sm">No portfolio uploaded yet</div>
                            @endif
                        </div>
                        
                        <label for="portfolio" class="block text-sm font-medium text-gray-300 mb-1">Upload Portfolio (Any File Type)</label>
                        <input type="file" id="portfolio" name="portfolio" 
                            class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                        <p class="text-gray-400 text-xs mt-1">Maximum file size: 10MB. You can upload any file type (ZIP, PDF, images, etc.)</p>
                        @error('portfolio')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        
                        <div class="mt-3">
                            <label for="portfolio_description" class="block text-sm font-medium text-gray-300 mb-1">Portfolio Description</label>
                            <textarea id="portfolio_description" name="portfolio_description" rows="3" 
                                class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">{{ old('portfolio_description', $profile->portfolio_description) }}</textarea>
                            <p class="text-gray-400 text-xs mt-1">Briefly describe your portfolio (what it contains, your work, etc.)</p>
                            @error('portfolio_description')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Skills Section -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-white mb-4">Skills</h2>
                    
                    <div class="mb-4">
                        <label for="skills" class="block text-sm font-medium text-gray-300 mb-1">Skills (separate with commas)</label>
                        <textarea id="skills" name="skills" rows="3" 
                            class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">{{ old('skills', $profile->skills) }}</textarea>
                        <p class="text-gray-400 text-xs mt-1">List your skills separated by commas (e.g., JavaScript, React, Node.js)</p>
                        @error('skills')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Experience Section -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-white mb-4">Work Experience</h2>
                    
                    <div class="mb-4">
                        <label for="experience" class="block text-sm font-medium text-gray-300 mb-1">Work Experience</label>
                        <textarea id="experience" name="experience" rows="5" 
                            class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">{{ old('experience', $profile->experience) }}</textarea>
                        <p class="text-gray-400 text-xs mt-1">Describe your work experience</p>
                        @error('experience')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Education Section -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-white mb-4">Education</h2>
                    
                    <div class="mb-4">
                        <label for="education" class="block text-sm font-medium text-gray-300 mb-1">Education</label>
                        <textarea id="education" name="education" rows="5" 
                            class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">{{ old('education', $profile->education) }}</textarea>
                        <p class="text-gray-400 text-xs mt-1">Describe your educational background</p>
                        @error('education')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Online Presence Section -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-white mb-4">Online Presence</h2>
                    
                    <!-- Website -->
                    <div class="mb-4">
                        <label for="website" class="block text-sm font-medium text-gray-300 mb-1">Website</label>
                        <input type="url" id="website" name="website" value="{{ old('website', $profile->website) }}" 
                            class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                        <p class="text-gray-400 text-xs mt-1">Your personal website or blog</p>
                        @error('website')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- LinkedIn -->
                    <div class="mb-4">
                        <label for="linkedin" class="block text-sm font-medium text-gray-300 mb-1">LinkedIn</label>
                        <input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin', $profile->linkedin) }}" 
                            class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                        <p class="text-gray-400 text-xs mt-1">Your LinkedIn profile URL</p>
                        @error('linkedin')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- GitHub -->
                    <div class="mb-4">
                        <label for="github" class="block text-sm font-medium text-gray-300 mb-1">GitHub</label>
                        <input type="url" id="github" name="github" value="{{ old('github', $profile->github) }}" 
                            class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                        <p class="text-gray-400 text-xs mt-1">Your GitHub profile URL</p>
                        @error('github')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Bio Section -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-white mb-4">Bio</h2>
                    
                    <div class="mb-4">
                        <label for="bio" class="block text-sm font-medium text-gray-300 mb-1">About Me</label>
                        <textarea id="bio" name="bio" rows="5" 
                            class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">{{ old('bio', $profile->bio) }}</textarea>
                        <p class="text-gray-400 text-xs mt-1">Tell employers about yourself, your career goals, and what you're looking for</p>
                        @error('bio')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-[#B9FF66] hover:bg-[#a7e55c] text-gray-900 font-medium py-2 px-6 rounded-lg transition duration-200">
                        Save Profile
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
