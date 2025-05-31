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
        
        <!-- Company Info -->
        <div class="mb-8">
            <div class="flex items-center">
                <div class="bg-gray-700 h-16 w-16 rounded-lg flex items-center justify-center text-white font-bold text-2xl mr-4">
                    {{ substr($employer->name, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $employer->name }}</h1>
                    @if(isset($employer->companyProfile) && $employer->companyProfile->industry)
                        <p class="text-gray-400">{{ $employer->companyProfile->industry }}</p>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Rating Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Overall Rating -->
            <div class="bg-gray-700 rounded-lg shadow-md p-5 border border-gray-600">
                <h2 class="text-lg font-medium text-white mb-3">Overall Rating</h2>
                <div class="flex items-center">
                    <div class="flex mr-2">
                        @php
                            $fullStars = floor($averageRating);
                            $halfStar = $averageRating - $fullStars > 0.3 && $averageRating - $fullStars < 0.8;
                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                        @endphp
                        
                        @for($i = 0; $i < $fullStars; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66]" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                        
                        @if($halfStar)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66]" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endif
                        
                        @for($i = 0; $i < $emptyStars; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <span class="text-2xl font-bold text-white">{{ number_format($averageRating, 1) }}</span>
                    <span class="text-gray-400 ml-2">out of 5</span>
                </div>
                <p class="text-gray-300 text-sm mt-2">Based on {{ $reviews->total() }} reviews</p>
            </div>
            
            <!-- Rating Distribution -->
            <div class="bg-gray-700 rounded-lg shadow-md p-5 border border-gray-600 md:col-span-2">
                <h2 class="text-lg font-medium text-white mb-3">Rating Distribution</h2>
                <div class="space-y-2">
                    @for($i = 5; $i >= 1; $i--)
                        <div class="flex items-center">
                            <div class="w-8 text-right mr-2 text-gray-300 text-sm">{{ $i }} ★</div>
                            <div class="flex-1 h-6 bg-gray-600 rounded-full overflow-hidden">
                                @php
                                    $percentage = $reviews->total() > 0 ? ($ratingCounts[$i] ?? 0) / $reviews->total() * 100 : 0;
                                @endphp
                                <div class="h-full bg-[#B9FF66]" style="width: {{ $percentage }}%"></div>
                            </div>
                            <div class="w-10 text-right ml-2 text-gray-300 text-sm">{{ $ratingCounts[$i] ?? 0 }}</div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        
        <!-- Add Review Button -->
        <div class="flex justify-end mb-8">
            <a href="{{ route('reviews.create', $employer->id) }}" class="bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-medium px-5 py-2 rounded-lg inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                </svg>
                Write a Review
            </a>
        </div>
        
        <!-- Reviews -->
        @if($reviews->isEmpty())
            <div class="bg-gray-700 rounded-lg p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                <p class="text-gray-300 text-lg mb-4">No reviews yet</p>
                <p class="text-gray-400 mb-6">Be the first to review this employer and help others make informed decisions.</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach($reviews as $review)
                    <div class="bg-gray-700 rounded-lg overflow-hidden shadow-md border border-gray-600">
                        <div class="p-5">
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
                                <div>
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-gray-600 flex items-center justify-center text-sm font-medium text-white mr-3">
                                            @if($review->anonymous)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            @else
                                                {{ substr($review->user->name, 0, 1) }}
                                            @endif
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-white">
                                                @if($review->anonymous)
                                                    Anonymous User
                                                @else
                                                    {{ $review->user->name }}
                                                @endif
                                            </h3>
                                            @if($review->job_title)
                                                <p class="text-xs text-gray-400">{{ $review->job_title }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-2 sm:mt-0">
                                    <div class="flex items-center">
                                        <div class="flex">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $i <= $review->rating ? 'text-[#B9FF66]' : 'text-gray-500' }}" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                        </div>
                                        
                                        <span class="text-gray-300 text-sm ml-2">
                                            {{ $review->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="text-gray-300 mb-4">{{ $review->content }}</p>
                            
                            @if($review->employment_period)
                                <div class="mt-2 text-sm text-gray-400">
                                    <span class="font-medium">Employment Period:</span> {{ $review->employment_period }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
                
                <div class="mt-6">
                    {{ $reviews->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
