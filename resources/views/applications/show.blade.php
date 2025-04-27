@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-900 to-gray-800 py-12 px-6">
    <div class="max-w-5xl mx-auto">
        <a href="{{ route('applications.index') }}" class="inline-flex items-center text-gray-400 hover:text-[#B9FF66] transition-colors mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Applications
        </a>

        <!-- Application Header -->
        <div class="bg-gray-800 rounded-2xl p-6 mb-8 border border-gray-700">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-white">Software Engineer Application</h1>
                    <p class="text-gray-400 mt-1">TechCorp • Applied on April 20, 2025</p>
                </div>
                <div class="flex items-center gap-4">
                    <span class="bg-yellow-100 text-yellow-800 text-sm font-medium px-3 py-1 rounded-full">
                        Reviewing
                    </span>
                    <button class="text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        Withdraw Application
                    </button>
                </div>
            </div>
        </div>

        <!-- Application Timeline -->
        <div class="bg-gray-800 rounded-2xl p-6 mb-8 border border-gray-700">
            <h2 class="text-xl font-bold text-white mb-6">Application Timeline</h2>
            
            <div class="relative">
                <!-- Timeline Line -->
                <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-gray-700"></div>
                
                <!-- Timeline Items -->
                <div class="space-y-8">
                    <!-- Application Submitted -->
                    <div class="relative flex items-start gap-6">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-[#B9FF66] flex items-center justify-center z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="flex-1 pt-1.5">
                            <h3 class="text-lg font-semibold text-white">Application Submitted</h3>
                            <p class="text-gray-400 mt-1">April 20, 2025 at 10:30 AM</p>
                            <p class="text-gray-300 mt-2">Your application has been successfully submitted to TechCorp.</p>
                        </div>
                    </div>
                    
                    <!-- Under Review -->
                    <div class="relative flex items-start gap-6">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-[#B9FF66] flex items-center justify-center z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="flex-1 pt-1.5">
                            <h3 class="text-lg font-semibold text-white">Under Review</h3>
                            <p class="text-gray-400 mt-1">April 22, 2025 at 2:15 PM</p>
                            <p class="text-gray-300 mt-2">Your application is currently being reviewed by the hiring team.</p>
                        </div>
                    </div>
                    
                    <!-- Shortlisted (Upcoming) -->
                    <div class="relative flex items-start gap-6">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-700 flex items-center justify-center z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1 pt-1.5">
                            <h3 class="text-lg font-semibold text-gray-400">Shortlisted</h3>
                            <p class="text-gray-500 mt-1">Pending</p>
                        </div>
                    </div>
                    
                    <!-- Interview (Upcoming) -->
                    <div class="relative flex items-start gap-6">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-700 flex items-center justify-center z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1 pt-1.5">
                            <h3 class="text-lg font-semibold text-gray-400">Interview</h3>
                            <p class="text-gray-500 mt-1">Pending</p>
                        </div>
                    </div>
                    
                    <!-- Decision (Upcoming) -->
                    <div class="relative flex items-start gap-6">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-700 flex items-center justify-center z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1 pt-1.5">
                            <h3 class="text-lg font-semibold text-gray-400">Decision</h3>
                            <p class="text-gray-500 mt-1">Pending</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Details -->
        <div class="bg-gray-800 rounded-2xl p-6 mb-8 border border-gray-700">
            <h2 class="text-xl font-bold text-white mb-6">Job Details</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Software Engineer</h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="text-gray-300">TechCorp</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-gray-300">San Francisco, CA (Remote)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-gray-300">Full-time</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-gray-300">$120,000 - $150,000 per year</span>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Your Application</h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-300">Applied on April 20, 2025</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="text-gray-300">Resume: <a href="#" class="text-[#B9FF66] hover:underline">view_resume.pdf</a></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-300">Cover Letter: <a href="#" class="text-[#B9FF66] hover:underline">view_cover_letter.pdf</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Employer -->
        <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
            <h2 class="text-xl font-bold text-white mb-6">Contact Employer</h2>
            
            <div class="flex flex-col md:flex-row gap-6">
                <a href="{{ route('conversations.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-[#B9FF66] text-black rounded-lg font-medium hover:bg-[#a8e65c] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    Send Message
                </a>
                <a href="#" class="inline-flex items-center justify-center px-6 py-3 bg-gray-700 text-white rounded-lg font-medium hover:bg-gray-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Email Recruiter
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
