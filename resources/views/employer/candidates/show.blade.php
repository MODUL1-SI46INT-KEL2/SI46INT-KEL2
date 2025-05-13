@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('employer.candidates.index') }}" class="inline-flex items-center text-gray-300 hover:text-[#B9FF66] transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Candidates
        </a>
    </div>
    
    <!-- Candidate Profile Card -->
    <div class="bg-gray-800 rounded-lg shadow-xl overflow-hidden mb-6">
        <!-- Profile Header with Background -->
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 p-6 pb-32">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">{{ $candidate->name }}</h1>
                    @if($candidate->jobseekerProfile && $candidate->jobseekerProfile->job_title)
                        <p class="text-xl text-[#B9FF66] font-medium">{{ $candidate->jobseekerProfile->job_title }}</p>
                    @endif
                </div>
                
                <!-- Available Badge -->
                @if($candidate->jobseekerProfile && $candidate->jobseekerProfile->available_for_hire)
                    <div>
                        <span class="bg-[#B9FF66] text-gray-900 text-xs font-bold px-3 py-1.5 rounded-full shadow-md">Available for hire</span>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Profile Info Card -->
        <div class="relative px-6 pb-6">
            <div class="bg-gray-700 rounded-lg shadow-lg p-6 -mt-24 mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="space-y-3">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mr-3" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        <span class="text-white">{{ $candidate->email }}</span>
                    </div>
                    
                    @if($candidate->phone)
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mr-3" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                            <span class="text-white">{{ $candidate->phone }}</span>
                        </div>
                    @endif
                    
                    @if($candidate->jobseekerProfile && $candidate->jobseekerProfile->location)
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mr-3" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-white">{{ $candidate->jobseekerProfile->location }}</span>
                        </div>
                    @endif
                </div>
                
                @if($candidate->jobseekerProfile && $candidate->jobseekerProfile->resume_path)
                    <a href="{{ asset('storage/' . $candidate->jobseekerProfile->resume_path) }}" target="_blank" 
                       class="bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-bold py-3 px-6 rounded-lg inline-flex items-center shadow-lg transition-all hover:shadow-xl transform hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        Download Resume
                    </a>
                @endif
            </div>
        </div>
        
        <!-- Candidate Profile Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-6">
            <div>
                <!-- Skills Section -->
                <div class="bg-gray-700 rounded-lg shadow-md p-6 mb-6">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                        <h2 class="text-xl font-bold text-white">Skills</h2>
                    </div>
                    @if($candidate->jobseekerProfile && $candidate->jobseekerProfile->skills)
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $candidate->jobseekerProfile->skills) as $skill)
                                <span class="bg-gray-800 text-[#B9FF66] px-4 py-2 rounded-lg text-sm font-medium shadow-sm border border-gray-600">{{ trim($skill) }}</span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-400">No skills listed</p>
                    @endif
                </div>
                
                <!-- Experience Section -->
                <div class="bg-gray-700 rounded-lg shadow-md p-6 mb-6">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <h2 class="text-xl font-bold text-white">Experience</h2>
                    </div>
                    @if($candidate->jobseekerProfile && $candidate->jobseekerProfile->experience)
                        <div class="bg-gray-800 rounded-lg p-5 border border-gray-600 shadow-inner">
                            <p class="text-gray-300 whitespace-pre-line leading-relaxed">{{ $candidate->jobseekerProfile->experience }}</p>
                        </div>
                    @else
                        <p class="text-gray-400">No experience listed</p>
                    @endif
                </div>
            </div>
            
            <div>
                <!-- Education Section -->
                <div class="bg-gray-700 rounded-lg shadow-md p-6 mb-6">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                        <h2 class="text-xl font-bold text-white">Education</h2>
                    </div>
                    @if($candidate->jobseekerProfile && $candidate->jobseekerProfile->education)
                        <div class="bg-gray-800 rounded-lg p-5 border border-gray-600 shadow-inner">
                            <p class="text-gray-300 whitespace-pre-line leading-relaxed">{{ $candidate->jobseekerProfile->education }}</p>
                        </div>
                    @else
                        <p class="text-gray-400">No education listed</p>
                    @endif
                </div>
                
                <!-- Online Presence Section -->
                <div class="bg-gray-700 rounded-lg shadow-md p-6 mb-6">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                        <h2 class="text-xl font-bold text-white">Online Presence</h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @if($candidate->jobseekerProfile && $candidate->jobseekerProfile->website)
                            <a href="{{ $candidate->jobseekerProfile->website }}" target="_blank" 
                               class="flex items-center bg-gray-800 hover:bg-gray-900 text-white p-4 rounded-lg border border-gray-600 transition-colors group">
                                <div class="bg-[#B9FF66] p-2 rounded-full mr-3 group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-900" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="font-medium">Website</span>
                                    <p class="text-xs text-gray-400 truncate max-w-[180px]">{{ $candidate->jobseekerProfile->website }}</p>
                                </div>
                            </a>
                        @endif
                        
                        @if($candidate->jobseekerProfile && $candidate->jobseekerProfile->linkedin)
                            <a href="{{ $candidate->jobseekerProfile->linkedin }}" target="_blank" 
                               class="flex items-center bg-gray-800 hover:bg-gray-900 text-white p-4 rounded-lg border border-gray-600 transition-colors group">
                                <div class="bg-[#0A66C2] p-2 rounded-full mr-3 group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="font-medium">LinkedIn</span>
                                    <p class="text-xs text-gray-400 truncate max-w-[180px]">{{ $candidate->jobseekerProfile->linkedin }}</p>
                                </div>
                            </a>
                        @endif
                        
                        @if($candidate->jobseekerProfile && $candidate->jobseekerProfile->github)
                            <a href="{{ $candidate->jobseekerProfile->github }}" target="_blank" 
                               class="flex items-center bg-gray-800 hover:bg-gray-900 text-white p-4 rounded-lg border border-gray-600 transition-colors group">
                                <div class="bg-[#333333] p-2 rounded-full mr-3 group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="font-medium">GitHub</span>
                                    <p class="text-xs text-gray-400 truncate max-w-[180px]">{{ $candidate->jobseekerProfile->github }}</p>
                                </div>
                            </a>
                        @endif
                        
                        @if(!($candidate->jobseekerProfile && ($candidate->jobseekerProfile->website || $candidate->jobseekerProfile->linkedin || $candidate->jobseekerProfile->github)))
                            <p class="text-gray-400">No online profiles listed</p>
                        @endif
                    </div>
                </div>
                
                <!-- Portfolio Section -->
                @if($candidate->jobseekerProfile && ($candidate->jobseekerProfile->portfolio_path || $candidate->jobseekerProfile->portfolio_description))
                    <div class="bg-gray-700 rounded-lg shadow-md p-6 mb-6">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <h2 class="text-xl font-bold text-white">Portfolio</h2>
                        </div>
                        <div class="bg-gray-800 rounded-lg p-5 border border-gray-600 shadow-inner">
                            @if($candidate->jobseekerProfile->portfolio_description)
                                <p class="text-gray-300 mb-5 whitespace-pre-line leading-relaxed">{{ $candidate->jobseekerProfile->portfolio_description }}</p>
                            @endif
                            
                            @if($candidate->jobseekerProfile->portfolio_path)
                                <a href="{{ asset('storage/' . $candidate->jobseekerProfile->portfolio_path) }}" target="_blank" 
                                   class="inline-flex items-center bg-gray-700 hover:bg-gray-600 text-[#B9FF66] font-medium py-2 px-4 rounded-lg transition-colors shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                        <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                    </svg>
                                    View Portfolio
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
                
                <!-- Bio Section -->
                @if($candidate->jobseekerProfile && $candidate->jobseekerProfile->bio)
                    <div class="bg-gray-700 rounded-lg shadow-md p-6 mb-6">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <h2 class="text-xl font-bold text-white">About</h2>
                        </div>
                        <div class="bg-gray-800 rounded-lg p-5 border border-gray-600 shadow-inner">
                            <p class="text-gray-300 whitespace-pre-line leading-relaxed">{{ $candidate->jobseekerProfile->bio }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Applications History -->
        <div class="px-6 mt-8 pt-8 border-t border-gray-700">
            <div class="flex items-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#B9FF66] mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h2 class="text-2xl font-bold text-white">Applications to Your Jobs</h2>
            </div>
            
            @if(count($applications) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($applications as $application)
                        <div class="bg-gray-700 rounded-lg shadow-md overflow-hidden transition-transform hover:scale-[1.02] hover:shadow-xl">
                            <!-- Job Title Bar -->
                            <div class="bg-gray-800 px-5 py-4 border-b border-gray-600">
                                <h3 class="text-lg font-bold text-white truncate">{{ $application->job->title }}</h3>
                            </div>
                            
                            <!-- Application Details -->
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <div class="flex items-center text-gray-300 text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Applied on {{ $application->created_at->format('M d, Y') }}
                                        </div>
                                        
                                        @if($application->status_updated_at)
                                            <div class="flex items-center text-gray-300 text-sm mt-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Status updated {{ $application->status_updated_at->diffForHumans() }}
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Status Badge -->
                                    <span class="px-3 py-1 rounded-full text-xs font-bold shadow-sm
                                        @if($application->status == 'pending') bg-yellow-200 text-yellow-800
                                        @elseif($application->status == 'reviewing') bg-blue-200 text-blue-800
                                        @elseif($application->status == 'shortlisted') bg-purple-200 text-purple-800
                                        @elseif($application->status == 'accepted') bg-green-200 text-green-800
                                        @elseif($application->status == 'rejected') bg-red-200 text-red-800
                                        @else bg-gray-200 text-gray-800
                                        @endif">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </div>
                                
                                <!-- Company Info -->
                                <div class="flex items-center text-gray-300 text-sm mb-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    {{ $application->job->company }}
                                </div>
                                
                                <a href="{{ route('employer.applications.show', $application->id) }}" 
                                   class="w-full inline-flex justify-center items-center bg-gray-600 hover:bg-gray-500 text-white font-medium py-2.5 px-4 rounded-lg transition-colors shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View Application
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-700 border border-gray-600 rounded-lg p-8 text-center shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-gray-300 text-lg">This candidate hasn't applied to any of your job postings yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
