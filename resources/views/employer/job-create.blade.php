@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl shadow-xl p-8 mb-8 border-l-4 border-[#B9FF66]">
            <h1 class="text-3xl font-bold text-white mb-2">Create New Job Posting</h1>
            <p class="text-gray-300">Fill out the form below to create a new job listing</p>
        </div>

        <!-- Form Section -->
        <div class="bg-gray-800/80 rounded-xl shadow-lg border border-gray-700 overflow-hidden">
            <div class="p-8">
                <form>
                    <!-- Job Details Section -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-white mb-6 pb-2 border-b border-gray-700">Job Details</h2>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="job_title" class="block text-gray-300 mb-2">Job Title <span class="text-red-500">*</span></label>
                                <input type="text" id="job_title" name="job_title" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent" placeholder="e.g. Senior Software Engineer" required>
                            </div>
                            
                            <div>
                                <label for="job_category" class="block text-gray-300 mb-2">Job Category <span class="text-red-500">*</span></label>
                                <select id="job_category" name="job_category" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent" required>
                                    <option value="">Select a category</option>
                                    <option value="technology">Technology</option>
                                    <option value="finance">Finance</option>
                                    <option value="healthcare">Healthcare</option>
                                    <option value="education">Education</option>
                                    <option value="marketing">Marketing</option>
                                    <option value="sales">Sales</option>
                                    <option value="customer_service">Customer Service</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="employment_type" class="block text-gray-300 mb-2">Employment Type <span class="text-red-500">*</span></label>
                                <select id="employment_type" name="employment_type" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent" required>
                                    <option value="">Select employment type</option>
                                    <option value="full_time">Full-time</option>
                                    <option value="part_time">Part-time</option>
                                    <option value="contract">Contract</option>
                                    <option value="temporary">Temporary</option>
                                    <option value="internship">Internship</option>
                                    <option value="freelance">Freelance</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="experience_level" class="block text-gray-300 mb-2">Experience Level <span class="text-red-500">*</span></label>
                                <select id="experience_level" name="experience_level" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent" required>
                                    <option value="">Select experience level</option>
                                    <option value="entry_level">Entry Level</option>
                                    <option value="mid_level">Mid Level</option>
                                    <option value="senior_level">Senior Level</option>
                                    <option value="executive">Executive</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <label for="job_description" class="block text-gray-300 mb-2">Job Description <span class="text-red-500">*</span></label>
                            <textarea id="job_description" name="job_description" rows="6" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent" placeholder="Describe the role, responsibilities, and requirements..." required></textarea>
                        </div>
                    </div>
                    
                    <!-- Salary & Location Section -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-white mb-6 pb-2 border-b border-gray-700">Salary & Location</h2>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="salary_min" class="block text-gray-300 mb-2">Minimum Salary</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-400">Rp</span>
                                    </div>
                                    <input type="number" id="salary_min" name="salary_min" class="w-full bg-gray-700 border border-gray-600 rounded-lg pl-10 pr-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent" placeholder="e.g. 5000000">
                                </div>
                            </div>
                            
                            <div>
                                <label for="salary_max" class="block text-gray-300 mb-2">Maximum Salary</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-400">Rp</span>
                                    </div>
                                    <input type="number" id="salary_max" name="salary_max" class="w-full bg-gray-700 border border-gray-600 rounded-lg pl-10 pr-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent" placeholder="e.g. 8000000">
                                </div>
                            </div>
                            
                            <div>
                                <label for="location" class="block text-gray-300 mb-2">Location <span class="text-red-500">*</span></label>
                                <input type="text" id="location" name="location" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent" placeholder="e.g. Jakarta, Indonesia" required>
                            </div>
                            
                            <div>
                                <label for="remote_option" class="block text-gray-300 mb-2">Remote Option</label>
                                <select id="remote_option" name="remote_option" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent">
                                    <option value="no">No remote work</option>
                                    <option value="hybrid">Hybrid remote</option>
                                    <option value="full">Fully remote</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Application Settings Section -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-white mb-6 pb-2 border-b border-gray-700">Application Settings</h2>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="application_deadline" class="block text-gray-300 mb-2">Application Deadline</label>
                                <input type="date" id="application_deadline" name="application_deadline" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="application_method" class="block text-gray-300 mb-2">Application Method <span class="text-red-500">*</span></label>
                                <select id="application_method" name="application_method" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent" required>
                                    <option value="platform">Apply through LokerNow</option>
                                    <option value="email">Apply via Email</option>
                                    <option value="website">Apply on Company Website</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <label for="application_instructions" class="block text-gray-300 mb-2">Application Instructions (Optional)</label>
                            <textarea id="application_instructions" name="application_instructions" rows="3" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent" placeholder="Additional instructions for applicants..."></textarea>
                        </div>
                    </div>
                    
                    <!-- Featured Listing Section (Professional & Enterprise Plans) -->
                    <div class="mb-8 bg-gray-700/30 rounded-lg p-6 border border-gray-600">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold text-white">Featured Listing</h2>
                            <span class="px-3 py-1 rounded-full bg-[#B9FF66]/20 text-[#B9FF66] text-xs font-medium">Professional Plan Feature</span>
                        </div>
                        
                        <p class="text-gray-300 mb-4">Make your job posting stand out by featuring it at the top of search results. Featured listings receive up to 5x more applications.</p>
                        
                        <div class="flex items-center justify-between p-4 bg-gray-700/50 rounded-lg border border-gray-600">
                            <div class="flex items-center">
                                <div class="relative inline-block w-12 mr-4 align-middle select-none">
                                    <input type="checkbox" id="featured" name="featured" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-700 appearance-none cursor-pointer transition-transform duration-200 ease-in-out checked:translate-x-6 checked:bg-[#B9FF66] checked:border-[#B9FF66]"/>
                                    <label for="featured" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-600 cursor-pointer"></label>
                                </div>
                                <label for="featured" class="text-white font-medium cursor-pointer">Feature this job posting</label>
                            </div>
                            
                            <div class="text-gray-300 text-sm">
                                <span class="font-medium">3/5</span> featured listings remaining this month
                            </div>
                        </div>
                        
                        <div class="mt-4 p-4 bg-gray-700/50 rounded-lg border border-gray-600">
                            <h3 class="text-white font-medium mb-2">Featured Duration</h3>
                            <div class="grid grid-cols-3 gap-3">
                                <label class="flex items-center justify-center p-3 bg-gray-700 rounded-lg border border-gray-600 cursor-pointer hover:bg-gray-600 transition-colors">
                                    <input type="radio" name="featured_duration" value="7" class="sr-only">
                                    <div class="text-center">
                                        <span class="block text-white font-medium">7 Days</span>
                                        <span class="block text-gray-400 text-sm">Recommended</span>
                                    </div>
                                </label>
                                
                                <label class="flex items-center justify-center p-3 bg-gray-700 rounded-lg border border-gray-600 cursor-pointer hover:bg-gray-600 transition-colors">
                                    <input type="radio" name="featured_duration" value="14" class="sr-only">
                                    <div class="text-center">
                                        <span class="block text-white font-medium">14 Days</span>
                                        <span class="block text-gray-400 text-sm">Popular</span>
                                    </div>
                                </label>
                                
                                <label class="flex items-center justify-center p-3 bg-gray-700 rounded-lg border border-gray-600 cursor-pointer hover:bg-gray-600 transition-colors">
                                    <input type="radio" name="featured_duration" value="30" class="sr-only">
                                    <div class="text-center">
                                        <span class="block text-white font-medium">30 Days</span>
                                        <span class="block text-gray-400 text-sm">Best Value</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Buttons -->
                    <div class="flex flex-wrap justify-end gap-4 mt-8">
                        <button type="button" class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors">
                            Save as Draft
                        </button>
                        <button type="submit" class="px-6 py-3 bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 rounded-lg font-medium transition-colors">
                            Publish Job
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
