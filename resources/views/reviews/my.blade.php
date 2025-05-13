@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold text-white mb-6">My Company Reviews</h1>
        
        @if(session('success'))
            <div class="bg-gray-700 border-l-4 border-[#B9FF66] text-white p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-gray-700 border-l-4 border-red-500 text-white p-4 mb-6">
                {{ session('error') }}
            </div>
        @endif

        @if(session('info'))
            <div class="bg-gray-700 border-l-4 border-blue-500 text-white p-4 mb-6">
                {{ session('info') }}
            </div>
        @endif
        
        @if($reviews->isEmpty())
            <div class="bg-gray-700 rounded-lg p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                <p class="text-gray-300 text-lg mb-4">You haven't submitted any company reviews yet.</p>
                <p class="text-gray-400 mb-6">Share your experience working with employers to help other job seekers make informed decisions.</p>
                <a href="{{ route('search.jobs') }}" class="inline-block bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-medium px-6 py-3 rounded-lg">
                    Find Companies to Review
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($reviews as $review)
                    <div class="bg-gray-700 rounded-lg overflow-hidden shadow-md border border-gray-600">
                        <div class="p-5">
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-white">{{ $review->employer->name }}</h3>
                                    @if($review->job_title)
                                        <p class="text-sm text-gray-300">{{ $review->job_title }}</p>
                                    @endif
                                </div>
                                
                                <div class="mt-2 sm:mt-0">
                                    <div class="flex items-center">
                                        <div class="flex items-center">
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
                            
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center text-sm text-gray-400">
                                <div>
                                    <span class="bg-gray-600 px-2 py-1 rounded text-xs mr-2">
                                        @if($review->anonymous)
                                            Anonymous
                                        @else
                                            Public
                                        @endif
                                    </span>
                                    
                                    <span class="bg-gray-600 px-2 py-1 rounded text-xs mr-2">
                                        @if($review->status === 'pending')
                                            <span class="text-yellow-400">Pending Review</span>
                                        @elseif($review->status === 'approved')
                                            <span class="text-green-400">Approved</span>
                                        @else
                                            <span class="text-red-400">Rejected</span>
                                        @endif
                                    </span>
                                </div>
                                
                                @if(in_array($review->status, ['pending', 'rejected']))
                                    <div class="mt-3 sm:mt-0">
                                        <a href="{{ route('reviews.edit', $review->id) }}" class="text-blue-400 hover:text-blue-300">
                                            Edit Review
                                        </a>
                                    </div>
                                @endif
                            </div>
                            
                            @if($review->status === 'rejected' && $review->rejection_reason)
                                <div class="mt-4 p-3 bg-gray-800 rounded-lg border border-red-500 text-sm">
                                    <h4 class="font-medium text-white mb-1">Rejection Reason:</h4>
                                    <p class="text-gray-300">{{ $review->rejection_reason }}</p>
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
