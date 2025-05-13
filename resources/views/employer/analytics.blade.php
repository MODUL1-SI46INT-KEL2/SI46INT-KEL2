@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl shadow-xl p-8 mb-8 border-l-4 border-[#B9FF66]">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Recruitment Analytics</h1>
                    <p class="text-gray-300">Track your hiring performance and optimize your recruitment strategy</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-[#B9FF66]/20 text-[#B9FF66] font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Professional Plan
                    </span>
                </div>
            </div>
        </div>

        <!-- Filter Controls -->
        <div class="bg-gray-800/80 rounded-xl shadow-lg p-6 border border-gray-700 mb-8">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-4">
                    <div>
                        <label for="date_range" class="block text-gray-300 text-sm mb-1">Date Range</label>
                        <select id="date_range" class="bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent">
                            <option value="7">Last 7 days</option>
                            <option value="30" selected>Last 30 days</option>
                            <option value="90">Last 90 days</option>
                            <option value="custom">Custom range</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="job_filter" class="block text-gray-300 text-sm mb-1">Job Posting</label>
                        <select id="job_filter" class="bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent">
                            <option value="all">All Job Postings</option>
                            <option value="1">Senior Software Engineer</option>
                            <option value="2">Marketing Manager</option>
                            <option value="3">UX Designer</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <button class="px-4 py-2 bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 rounded-lg text-sm font-medium transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Export Report
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Key Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Applications -->
            <div class="bg-gray-800/80 rounded-xl shadow-lg p-6 border border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-300 font-medium">Total Applications</h3>
                    <div class="bg-blue-900/30 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-3xl font-bold text-white">187</p>
                        <p class="text-green-400 text-sm mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            +12.5% vs last period
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Qualified Candidates -->
            <div class="bg-gray-800/80 rounded-xl shadow-lg p-6 border border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-300 font-medium">Qualified Candidates</h3>
                    <div class="bg-green-900/30 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-3xl font-bold text-white">62</p>
                        <p class="text-green-400 text-sm mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            +8.7% vs last period
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Interviews Scheduled -->
            <div class="bg-gray-800/80 rounded-xl shadow-lg p-6 border border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-300 font-medium">Interviews Scheduled</h3>
                    <div class="bg-purple-900/30 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-3xl font-bold text-white">28</p>
                        <p class="text-green-400 text-sm mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            +5.2% vs last period
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Time to Hire -->
            <div class="bg-gray-800/80 rounded-xl shadow-lg p-6 border border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-300 font-medium">Avg. Time to Hire</h3>
                    <div class="bg-yellow-900/30 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <p class="text-3xl font-bold text-white">18.5 <span class="text-lg font-normal">days</span></p>
                        <p class="text-red-400 text-sm mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                            </svg>
                            +2.3 days vs last period
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Applications Over Time -->
            <div class="bg-gray-800/80 rounded-xl shadow-lg p-6 border border-gray-700">
                <h3 class="text-lg font-bold text-white mb-6">Applications Over Time</h3>
                
                <div class="h-64 flex items-end justify-between space-x-2">
                    <!-- Simulated chart bars -->
                    <div class="w-full h-full flex items-end justify-between space-x-2">
                        <div class="w-full h-[30%] bg-[#B9FF66]/70 rounded-t-md"></div>
                        <div class="w-full h-[45%] bg-[#B9FF66]/70 rounded-t-md"></div>
                        <div class="w-full h-[60%] bg-[#B9FF66]/70 rounded-t-md"></div>
                        <div class="w-full h-[40%] bg-[#B9FF66]/70 rounded-t-md"></div>
                        <div class="w-full h-[75%] bg-[#B9FF66]/70 rounded-t-md"></div>
                        <div class="w-full h-[90%] bg-[#B9FF66]/70 rounded-t-md"></div>
                        <div class="w-full h-[65%] bg-[#B9FF66]/70 rounded-t-md"></div>
                        <div class="w-full h-[80%] bg-[#B9FF66]/70 rounded-t-md"></div>
                        <div class="w-full h-[50%] bg-[#B9FF66]/70 rounded-t-md"></div>
                        <div class="w-full h-[70%] bg-[#B9FF66]/70 rounded-t-md"></div>
                        <div class="w-full h-[85%] bg-[#B9FF66]/70 rounded-t-md"></div>
                        <div class="w-full h-[55%] bg-[#B9FF66]/70 rounded-t-md"></div>
                    </div>
                </div>
                
                <div class="flex justify-between mt-4 text-xs text-gray-400">
                    <span>Apr 1</span>
                    <span>Apr 8</span>
                    <span>Apr 15</span>
                    <span>Apr 22</span>
                    <span>Apr 30</span>
                </div>
            </div>
            
            <!-- Source Breakdown -->
            <div class="bg-gray-800/80 rounded-xl shadow-lg p-6 border border-gray-700">
                <h3 class="text-lg font-bold text-white mb-6">Application Sources</h3>
                
                <div class="space-y-4">
                    <!-- Direct Applications -->
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-gray-300">Direct</span>
                            <span class="text-gray-300">42%</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2.5">
                            <div class="bg-[#B9FF66] h-2.5 rounded-full" style="width: 42%"></div>
                        </div>
                    </div>
                    
                    <!-- LinkedIn -->
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-gray-300">LinkedIn</span>
                            <span class="text-gray-300">28%</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2.5">
                            <div class="bg-blue-500 h-2.5 rounded-full" style="width: 28%"></div>
                        </div>
                    </div>
                    
                    <!-- Job Boards -->
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-gray-300">Job Boards</span>
                            <span class="text-gray-300">18%</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2.5">
                            <div class="bg-purple-500 h-2.5 rounded-full" style="width: 18%"></div>
                        </div>
                    </div>
                    
                    <!-- Referrals -->
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-gray-300">Referrals</span>
                            <span class="text-gray-300">12%</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2.5">
                            <div class="bg-yellow-500 h-2.5 rounded-full" style="width: 12%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Advanced Analytics (Professional Plan Feature) -->
        <div class="bg-gray-800/80 rounded-xl shadow-lg p-8 border border-gray-700 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-white">Advanced Analytics</h2>
                <span class="px-3 py-1 rounded-full bg-[#B9FF66]/20 text-[#B9FF66] text-xs font-medium">Professional Plan Feature</span>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Candidate Demographics -->
                <div>
                    <h3 class="text-lg font-medium text-white mb-4">Candidate Demographics</h3>
                    
                    <div class="bg-gray-700/30 rounded-lg p-4">
                        <h4 class="text-gray-300 font-medium mb-3">Experience Level</h4>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="w-2/5">
                                    <span class="text-gray-300 text-sm">Entry Level</span>
                                </div>
                                <div class="w-3/5 flex items-center">
                                    <div class="w-[35%] h-2 bg-blue-500 rounded-full mr-2"></div>
                                    <span class="text-gray-400 text-xs">35%</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-2/5">
                                    <span class="text-gray-300 text-sm">Mid Level</span>
                                </div>
                                <div class="w-3/5 flex items-center">
                                    <div class="w-[45%] h-2 bg-[#B9FF66] rounded-full mr-2"></div>
                                    <span class="text-gray-400 text-xs">45%</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-2/5">
                                    <span class="text-gray-300 text-sm">Senior Level</span>
                                </div>
                                <div class="w-3/5 flex items-center">
                                    <div class="w-[20%] h-2 bg-purple-500 rounded-full mr-2"></div>
                                    <span class="text-gray-400 text-xs">20%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-700/30 rounded-lg p-4 mt-4">
                        <h4 class="text-gray-300 font-medium mb-3">Education</h4>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="w-2/5">
                                    <span class="text-gray-300 text-sm">Bachelor's</span>
                                </div>
                                <div class="w-3/5 flex items-center">
                                    <div class="w-[65%] h-2 bg-blue-500 rounded-full mr-2"></div>
                                    <span class="text-gray-400 text-xs">65%</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-2/5">
                                    <span class="text-gray-300 text-sm">Master's</span>
                                </div>
                                <div class="w-3/5 flex items-center">
                                    <div class="w-[30%] h-2 bg-[#B9FF66] rounded-full mr-2"></div>
                                    <span class="text-gray-400 text-xs">30%</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-2/5">
                                    <span class="text-gray-300 text-sm">PhD</span>
                                </div>
                                <div class="w-3/5 flex items-center">
                                    <div class="w-[5%] h-2 bg-purple-500 rounded-full mr-2"></div>
                                    <span class="text-gray-400 text-xs">5%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Conversion Funnel -->
                <div>
                    <h3 class="text-lg font-medium text-white mb-4">Recruitment Funnel</h3>
                    
                    <div class="bg-gray-700/30 rounded-lg p-6 h-[calc(100%-32px)]">
                        <div class="flex flex-col h-full">
                            <div class="py-3 px-4 bg-blue-900/30 text-blue-400 rounded-t-lg text-center mb-1">
                                <div class="font-medium">Applications</div>
                                <div class="text-2xl font-bold">187</div>
                                <div class="text-xs">100%</div>
                            </div>
                            
                            <div class="py-3 px-4 bg-green-900/30 text-green-400 text-center mb-1 rounded-sm" style="width: 80%; margin-left: auto; margin-right: auto;">
                                <div class="font-medium">Resume Screening</div>
                                <div class="text-2xl font-bold">149</div>
                                <div class="text-xs">80%</div>
                            </div>
                            
                            <div class="py-3 px-4 bg-yellow-900/30 text-yellow-400 text-center mb-1 rounded-sm" style="width: 60%; margin-left: auto; margin-right: auto;">
                                <div class="font-medium">Phone Screening</div>
                                <div class="text-2xl font-bold">112</div>
                                <div class="text-xs">60%</div>
                            </div>
                            
                            <div class="py-3 px-4 bg-purple-900/30 text-purple-400 text-center mb-1 rounded-sm" style="width: 40%; margin-left: auto; margin-right: auto;">
                                <div class="font-medium">Interviews</div>
                                <div class="text-2xl font-bold">75</div>
                                <div class="text-xs">40%</div>
                            </div>
                            
                            <div class="py-3 px-4 bg-[#B9FF66]/30 text-[#B9FF66] text-center rounded-b-lg" style="width: 15%; margin-left: auto; margin-right: auto;">
                                <div class="font-medium">Offers</div>
                                <div class="text-2xl font-bold">28</div>
                                <div class="text-xs">15%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Premium Analytics Teaser (Enterprise Plan) -->
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl shadow-xl p-8 border border-gray-700">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="mb-6 md:mb-0 md:mr-8">
                    <div class="flex items-center mb-2">
                        <h2 class="text-xl font-bold text-white">Premium Analytics</h2>
                        <span class="ml-3 px-3 py-1 rounded-full bg-gray-700 text-gray-300 text-xs font-medium">Enterprise Plan Feature</span>
                    </div>
                    <p class="text-gray-300 mb-4">Unlock advanced insights with our Premium Analytics package, including:</p>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-gray-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-400">Predictive hiring insights and AI recommendations</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-gray-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-400">Industry benchmarking and competitive analysis</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-gray-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-400">Custom reporting and data exports</span>
                        </li>
                    </ul>
                </div>
                
                <div>
                    <a href="{{ route('pricing') }}" class="inline-flex items-center bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        Upgrade to Enterprise
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
