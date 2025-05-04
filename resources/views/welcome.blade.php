<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LokerNow - Find Your Dream Job</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background-color: #111827; /* dark gray-900 */
                color: #fff;
            }
            .btn-primary {
                background-color: #B9FF66;
                color: #000;
                transition: all 0.2s ease;
            }
            .btn-primary:hover {
                background-color: #a7e55c;
            }
            .btn-secondary {
                background-color: #1F2937; /* dark gray-800 */
                color: #fff;
                border: 1px solid #374151; /* dark gray-700 */
                transition: all 0.2s ease;
            }
            .btn-secondary:hover {
                border-color: #4B5563; /* dark gray-600 */
                background-color: #374151; /* dark gray-700 */
            }
            .job-card {
                transition: all 0.2s ease;
                background-color: #1F2937 !important; /* dark gray-800 */
                border: 1px solid #374151; /* dark gray-700 */
            }
            .job-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -2px rgba(0, 0, 0, 0.3);
            }
            .category-tab {
                transition: all 0.2s ease;
            }
            .category-tab:hover {
                background-color: #374151; /* dark gray-700 */
            }
            .category-tab.active {
                border-bottom: 2px solid #B9FF66;
                font-weight: 500;
                color: #fff !important;
            }
        </style>
    </head>
    <body class="antialiased bg-gray-900 text-white">
        <!-- Navigation -->
        <nav class="bg-gray-800 shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <span class="text-2xl font-bold text-white">Loker<span class="text-[#B9FF66]">Now</span></span>
                        </div>
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <a href="#" class="border-transparent text-gray-300 hover:text-white hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Home
                            </a>
                            <a href="#" class="border-transparent text-gray-300 hover:text-white hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Jobs
                            </a>
                            <a href="#" class="border-transparent text-gray-300 hover:text-white hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Companies
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @if (Route::has('login'))
                            <div class="hidden space-x-4 sm:flex">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-300 hover:text-white">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-300 hover:text-white">Log in</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn-primary px-4 py-2 rounded-md text-sm font-medium">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Search Bar -->
        <div class="bg-gray-800 py-6 shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow">
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" class="focus:ring-[#B9FF66] focus:border-[#B9FF66] block w-full pl-10 pr-3 py-3 bg-gray-700 border-gray-600 text-white rounded-md placeholder-gray-400" placeholder="Job Position">
                        </div>
                    </div>
                    <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-black bg-[#B9FF66] hover:bg-[#a7e55c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66] focus:ring-offset-gray-800">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                        Search
                    </button>
                </div>
            </div>
        </div>

        <!-- Job Categories -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex overflow-x-auto pb-2 space-x-4">
                <a href="#" class="category-tab active whitespace-nowrap px-4 py-2 text-sm font-medium text-white">
                    Featured Jobs
                </a>
                <a href="#" class="category-tab whitespace-nowrap px-4 py-2 text-sm font-medium text-gray-400">
                    Remote Jobs
                </a>
                <a href="#" class="category-tab whitespace-nowrap px-4 py-2 text-sm font-medium text-gray-400">
                    Hybrid
                </a>
                <a href="#" class="category-tab whitespace-nowrap px-4 py-2 text-sm font-medium text-gray-400">
                    Fresh Grads
                    <span class="ml-1 px-2 py-0.5 text-xs font-medium rounded-full bg-red-900 text-red-200">NEW</span>
                </a>
                <a href="#" class="category-tab whitespace-nowrap px-4 py-2 text-sm font-medium text-gray-400">
                    All Jobs
                </a>
                <a href="#" class="category-tab whitespace-nowrap px-4 py-2 text-sm font-medium text-gray-400">
                    New Jobs
                </a>
                <a href="#" class="category-tab whitespace-nowrap px-4 py-2 text-sm font-medium text-gray-400">
                    Internship and Junior Level Jobs
                </a>
            </div>
        </div>

        <!-- Job Listings -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if(count($featuredJobs) == 0)
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16 bg-gray-800 rounded-lg p-8 border border-gray-700">
                        <h3 class="text-2xl font-bold text-white mb-2">No job listings found</h3>
                        <p class="text-gray-400 mb-6 max-w-md mx-auto">We're currently updating our job listings. Please check back soon for new opportunities.</p>
                    </div>
                @else
                    @foreach($featuredJobs as $job)
                        <div class="job-card bg-gray-800 rounded-lg shadow overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-start justify-between">
                                    <div class="flex-shrink-0 h-14 w-14 rounded-md flex items-center justify-center overflow-hidden">
                                        @if(isset($jobPosters[$job->id_admin]) && 
                                            isset($companyProfiles[$jobPosters[$job->id_admin]->company_profile_id]) && 
                                            $companyProfiles[$jobPosters[$job->id_admin]->company_profile_id]->logo_path)
                                            <img src="{{ asset('storage/' . $companyProfiles[$jobPosters[$job->id_admin]->company_profile_id]->logo_path) }}" 
                                                alt="{{ $job->company }} logo" class="w-14 h-14 object-cover">
                                        @else
                                            <div class="w-14 h-14 bg-[#B9FF66] text-black flex items-center justify-center text-lg font-bold">
                                                {{ strtoupper(substr($job->company, 0, 2)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <button class="text-gray-400 hover:text-gray-300">
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                                <h3 class="mt-4 text-lg font-medium text-white">{{ $job->title }}</h3>
                                <p class="text-sm text-gray-400">{{ isset($jobPosters[$job->id_admin]) && isset($companyProfiles[$jobPosters[$job->id_admin]->company_profile_id]) ? $companyProfiles[$jobPosters[$job->id_admin]->company_profile_id]->name : $job->company }}</p>
                                <div class="mt-4">
                                    <div class="flex items-center text-sm text-gray-400">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $job->location ?: 'Remote' }}
                                    </div>
                                    <div class="mt-2 flex items-center text-sm text-gray-400">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $job->salary ? '$'.number_format($job->salary, 0) : 'Salary not specified' }}
                                    </div>
                                    <div class="mt-2 flex items-center text-sm text-gray-400">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $job->position_type ?: 'Full-time' }}
                                    </div>
                                    <div class="mt-2 flex items-center text-sm text-gray-400">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                        Posted {{ $job->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-700 px-6 py-4 flex items-center justify-between">
                                <span class="text-xs font-medium text-gray-300">{{ $job->category }}</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-[#B9FF66] text-black">
                                    {{ $job->job_type ?: 'On-site' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

            <div class="mt-8 text-center col-span-1 md:col-span-2 lg:col-span-3">
                <a href="{{ route('search.jobs') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-black bg-[#B9FF66] hover:bg-[#a7e55c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66] focus:ring-offset-gray-800">
                    View More Jobs
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800">
            <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
                <div class="mt-8 flex justify-center space-x-6">
                    <p class="text-center text-base text-gray-400">
                        &copy; {{ date('Y') }} LokerNow. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>