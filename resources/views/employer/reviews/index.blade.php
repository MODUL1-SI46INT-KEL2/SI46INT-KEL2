@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold text-white mb-6">Company Reviews</h1>
        
        @if(session('success'))
            <div class="bg-gray-700 border-l-4 border-[#B9FF66] text-white p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Rating Stats Card -->
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
                <p class="text-gray-300 text-sm mt-2">Based on {{ $totalReviews }} reviews</p>
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
                                    $percentage = $totalReviews > 0 ? ($ratingDistribution[$i] / $totalReviews) * 100 : 0;
                                @endphp
                                <div class="h-full bg-[#B9FF66]" style="width: {{ $percentage }}%"></div>
                            </div>
                            <div class="w-10 text-right ml-2 text-gray-300 text-sm">{{ $ratingDistribution[$i] }}</div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        
        <!-- Filter and Sort Options -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('employer.reviews.index') }}" class="px-4 py-2 rounded-full text-sm {{ !request('rating') ? 'bg-[#B9FF66] text-gray-900 font-medium' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                    All Reviews
                </a>
                @for($i = 5; $i >= 1; $i--)
                    <a href="{{ route('employer.reviews.index', ['rating' => $i]) }}" class="px-4 py-2 rounded-full text-sm {{ request('rating') == $i ? 'bg-[#B9FF66] text-gray-900 font-medium' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                        {{ $i }} Star{{ $i !== 1 ? 's' : '' }}
                    </a>
                @endfor
            </div>
            
            <div class="w-full md:w-auto">
                <select onchange="window.location.href='{{ route('employer.reviews.index') }}?sort='+this.value{{ request('rating') ? '&rating='.request('rating') : '' }}" class="bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white focus:outline-none focus:ring-1 focus:ring-[#B9FF66] w-full md:w-auto">
                    <option value="newest" {{ request('sort') == 'newest' || !request('sort') ? 'selected' : '' }}>Newest First</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    <option value="highest" {{ request('sort') == 'highest' ? 'selected' : '' }}>Highest Rated</option>
                    <option value="lowest" {{ request('sort') == 'lowest' ? 'selected' : '' }}>Lowest Rated</option>
                </select>
            </div>
        </div>
        
        <!-- Reviews List -->
        @if($reviews->isEmpty())
            <div class="bg-gray-700 rounded-lg p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                <p class="text-gray-300 text-lg mb-4">No reviews found</p>
                <p class="text-gray-400">There are no reviews matching your current filter criteria.</p>
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
        
        <!-- Add Review CTA -->
        <div class="mt-8 bg-gray-700 rounded-lg p-6 shadow-md border border-gray-600">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-lg font-semibold text-white mb-1">Do you see incorrect or inappropriate reviews?</h3>
                    <p class="text-gray-300">Contact us for assistance in reviewing your company's reviews.</p>
                </div>
                <a href="mailto:support@lokernow.com" class="bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-medium px-5 py-2 rounded-lg inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                    Contact Support
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
