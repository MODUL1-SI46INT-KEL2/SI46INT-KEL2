<!-- Company Reviews Dashboard Widget -->
<div class="bg-gray-800 rounded-xl shadow-sm border border-gray-700 overflow-hidden mb-6">
    <div class="p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-white">Company Reviews</h2>
            <a href="{{ route('employer.reviews.index') }}" class="text-[#B9FF66] hover:text-white text-sm font-medium">
                View All
            </a>
        </div>

        @if($totalReviews > 0)
            <div class="flex items-center mb-4">
                <div class="flex items-center mr-4">
                    <div class="flex mr-2">
                        @php
                            $fullStars = floor($averageRating);
                            $halfStar = $averageRating - $fullStars > 0.3 && $averageRating - $fullStars < 0.8;
                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                        @endphp
                        
                        @for($i = 0; $i < $fullStars; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66]" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                        
                        @if($halfStar)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66]" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endif
                        
                        @for($i = 0; $i < $emptyStars; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <span class="text-xl font-bold text-white">{{ number_format($averageRating, 1) }}</span>
                </div>
                <span class="text-gray-400 text-sm">{{ $totalReviews }} {{ Str::plural('review', $totalReviews) }}</span>
            </div>
            
            @if($recentReviews->isNotEmpty())
                <div class="space-y-4">
                    @foreach($recentReviews as $review)
                        <div class="bg-gray-700 rounded-lg p-4 border border-gray-600">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $i <= $review->rating ? 'text-[#B9FF66]' : 'text-gray-500' }}" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-xs text-gray-400">{{ $review->created_at->format('M d, Y') }}</span>
                            </div>
                            <p class="text-gray-300 text-sm">{{ Str::limit($review->content, 120) }}</p>
                            <div class="mt-2 text-xs text-gray-400">
                                By: {{ $review->anonymous ? 'Anonymous User' : $review->user->name }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @else
            <div class="bg-gray-700 rounded-lg border border-gray-600 p-4 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-gray-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                <p class="text-gray-300">No reviews yet</p>
                <p class="text-sm text-gray-400 mt-1">Reviews will appear here once job seekers leave feedback.</p>
            </div>
        @endif
    </div>
</div>
