@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
        <div class="mb-6">
            <a href="{{ route('employer.reviews.index') }}" class="inline-flex items-center text-[#B9FF66] hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to All Reviews
            </a>
        </div>
        
        <h1 class="text-2xl font-bold text-white mb-6">Review Details</h1>
        
        <div class="bg-gray-700 rounded-lg overflow-hidden shadow-md border border-gray-600 mb-8">
            <div class="p-6">
                <!-- Review Header -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                    <div class="flex items-center">
                        <div class="h-12 w-12 rounded-full bg-gray-600 flex items-center justify-center text-sm font-medium text-white mr-4">
                            @if($review->anonymous)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            @else
                                {{ substr($review->user->name, 0, 1) }}
                            @endif
                        </div>
                        <div>
                            <h3 class="font-medium text-white text-lg">
                                @if($review->anonymous)
                                    Anonymous User
                                @else
                                    {{ $review->user->name }}
                                @endif
                            </h3>
                            @if($review->job_title)
                                <p class="text-sm text-gray-400">{{ $review->job_title }}</p>
                            @endif
                            @if($review->employment_period)
                                <p class="text-xs text-gray-400">{{ $review->employment_period }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mt-4 sm:mt-0">
                        <div class="flex items-center">
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ $i <= $review->rating ? 'text-[#B9FF66]' : 'text-gray-500' }}" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            
                            <span class="text-white font-semibold text-lg ml-2">
                                {{ $review->rating }}.0
                            </span>
                        </div>
                        <div class="text-right text-sm text-gray-400 mt-1">
                            Submitted on {{ $review->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>
                
                <!-- Review Content -->
                <div class="bg-gray-800 rounded-lg p-6 border border-gray-600 mb-6">
                    <h4 class="text-white font-medium mb-3">Review:</h4>
                    <p class="text-gray-300 whitespace-pre-line">{{ $review->content }}</p>
                </div>
                
                <!-- Review Metadata -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-800 rounded-lg p-4 border border-gray-600">
                        <h4 class="text-white font-medium mb-2">Review Status:</h4>
                        <div class="flex items-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Approved
                            </span>
                            <span class="text-gray-400 text-sm ml-2">
                                This review is visible to all users
                            </span>
                        </div>
                    </div>
                    
                    <div class="bg-gray-800 rounded-lg p-4 border border-gray-600">
                        <h4 class="text-white font-medium mb-2">Visibility:</h4>
                        <div class="flex items-center">
                            @if($review->anonymous)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Anonymous
                                </span>
                                <span class="text-gray-400 text-sm ml-2">
                                    User's identity is hidden
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Public
                                </span>
                                <span class="text-gray-400 text-sm ml-2">
                                    User's name is visible
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contact Support Card -->
        <div class="bg-gray-700 rounded-lg p-6 shadow-md border border-gray-600">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-lg font-semibold text-white mb-1">Do you feel this review is inappropriate?</h3>
                    <p class="text-gray-300">Contact our support team to review this content.</p>
                </div>
                <a href="mailto:support@lokernow.com?subject=Review%20Report%20(ID:{{ $review->id }})" class="bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-medium px-5 py-2 rounded-lg inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    Report This Review
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
