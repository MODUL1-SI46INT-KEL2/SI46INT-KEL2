@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('admin.reviews.index') }}" class="inline-flex items-center text-[#B9FF66] hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to Reviews
            </a>
            
            <div class="flex space-x-3">
                @if($review->status === 'pending')
                    <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-900 bg-[#B9FF66] hover:bg-[#a8eb55] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Approve Review
                        </button>
                    </form>
                    
                    <button type="button" onclick="toggleRejectModal()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        Reject Review
                    </button>
                @endif
            </div>
        </div>
        
        <div class="bg-gray-700 rounded-lg overflow-hidden border border-gray-600 mb-8">
            <!-- Review Header -->
            <div class="p-5 border-b border-gray-600">
                <div class="flex flex-col sm:flex-row justify-between">
                    <div class="mb-4 sm:mb-0">
                        <div class="flex items-center">
                            <div class="h-12 w-12 rounded-full bg-gray-600 flex items-center justify-center text-lg font-medium text-white mr-4">
                                @if($review->anonymous)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                @else
                                    {{ substr($review->user->name, 0, 1) }}
                                @endif
                            </div>
                            
                            <div>
                                <h2 class="text-lg font-medium text-white">
                                    @if($review->anonymous)
                                        Anonymous User
                                    @else
                                        {{ $review->user->name }}
                                    @endif
                                </h2>
                                <div class="flex items-center text-sm text-gray-400">
                                    <span class="mr-3">{{ $review->created_at->format('M d, Y') }}</span>
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium 
                                        @if($review->status === 'pending') bg-yellow-500 bg-opacity-20 text-yellow-300
                                        @elseif($review->status === 'approved') bg-green-500 bg-opacity-20 text-green-300
                                        @elseif($review->status === 'rejected') bg-red-500 bg-opacity-20 text-red-300
                                        @endif">
                                        {{ ucfirst($review->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex flex-col items-end">
                        <div class="flex mb-1">
                            @for($i = 1; $i <= 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ $i <= $review->rating ? 'text-[#B9FF66]' : 'text-gray-500' }}" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                        <span class="text-sm text-gray-400">Rating: {{ $review->rating }}/5</span>
                    </div>
                </div>
            </div>
            
            <!-- Review Content -->
            <div class="p-5">
                <div class="text-white mb-6">{{ $review->content }}</div>
                
                @if($review->job_title || $review->employment_period)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        @if($review->job_title)
                            <div>
                                <span class="block text-sm text-gray-400 mb-1">Job Title</span>
                                <span class="text-white">{{ $review->job_title }}</span>
                            </div>
                        @endif
                        
                        @if($review->employment_period)
                            <div>
                                <span class="block text-sm text-gray-400 mb-1">Employment Period</span>
                                <span class="text-white">{{ $review->employment_period }}</span>
                            </div>
                        @endif
                    </div>
                @endif
                
                @if($review->status === 'rejected' && $review->rejection_reason)
                    <div class="bg-red-900 bg-opacity-20 border border-red-800 rounded-md p-4 mt-6">
                        <h3 class="text-red-300 font-medium mb-2">Rejection Reason</h3>
                        <p class="text-white">{{ $review->rejection_reason }}</p>
                        <div class="mt-2 text-xs text-gray-400">
                            Rejected by: {{ $review->moderator->name ?? 'Admin' }} on {{ $review->moderated_at ? $review->moderated_at->format('M d, Y H:i') : 'N/A' }}
                        </div>
                    </div>
                @endif
                
                @if($review->status === 'approved' && $review->moderated_at)
                    <div class="bg-green-900 bg-opacity-20 border border-green-800 rounded-md p-4 mt-6">
                        <h3 class="text-green-300 font-medium mb-2">Approval Information</h3>
                        <div class="text-xs text-gray-400">
                            Approved by: {{ $review->moderator->name ?? 'Admin' }} on {{ $review->moderated_at->format('M d, Y H:i') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- More Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- User Information -->
            <div class="bg-gray-700 rounded-lg p-5 border border-gray-600">
                <h3 class="text-lg font-medium text-white mb-4">User Information</h3>
                
                <dl class="space-y-3">
                    <div class="grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-400">Name</dt>
                        <dd class="text-sm text-white col-span-2">{{ $review->user->name }}</dd>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-400">Email</dt>
                        <dd class="text-sm text-white col-span-2">{{ $review->user->email }}</dd>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-400">Anonymous</dt>
                        <dd class="text-sm text-white col-span-2">{{ $review->anonymous ? 'Yes' : 'No' }}</dd>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-400">Joined</dt>
                        <dd class="text-sm text-white col-span-2">{{ $review->user->created_at->format('M d, Y') }}</dd>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-400">Total Reviews</dt>
                        <dd class="text-sm text-white col-span-2">{{ $userTotalReviews }}</dd>
                    </div>
                </dl>
            </div>
            
            <!-- Company Information -->
            <div class="bg-gray-700 rounded-lg p-5 border border-gray-600">
                <h3 class="text-lg font-medium text-white mb-4">Company Information</h3>
                
                <dl class="space-y-3">
                    <div class="grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-400">Name</dt>
                        <dd class="text-sm text-white col-span-2">{{ $review->employer->name }}</dd>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-400">Email</dt>
                        <dd class="text-sm text-white col-span-2">{{ $review->employer->email }}</dd>
                    </div>
                    
                    @if(isset($review->employer->companyProfile))
                        @if($review->employer->companyProfile->industry)
                            <div class="grid grid-cols-3 gap-4">
                                <dt class="text-sm font-medium text-gray-400">Industry</dt>
                                <dd class="text-sm text-white col-span-2">{{ $review->employer->companyProfile->industry }}</dd>
                            </div>
                        @endif
                        
                        @if($review->employer->companyProfile->size)
                            <div class="grid grid-cols-3 gap-4">
                                <dt class="text-sm font-medium text-gray-400">Company Size</dt>
                                <dd class="text-sm text-white col-span-2">{{ $review->employer->companyProfile->size }}</dd>
                            </div>
                        @endif
                    @endif
                    
                    <div class="grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-400">Avg. Rating</dt>
                        <dd class="text-sm text-white col-span-2">
                            <div class="flex items-center">
                                <span class="mr-2">{{ number_format($companyAvgRating, 1) }}</span>
                                <div class="flex">
                                    @php
                                        $fullStars = floor($companyAvgRating);
                                        $halfStar = $companyAvgRating - $fullStars > 0.3 && $companyAvgRating - $fullStars < 0.8;
                                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                    @endphp
                                    
                                    @for($i = 0; $i < $fullStars; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#B9FF66]" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                    
                                    @if($halfStar)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#B9FF66]" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endif
                                    
                                    @for($i = 0; $i < $emptyStars; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        </dd>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-400">Total Reviews</dt>
                        <dd class="text-sm text-white col-span-2">{{ $companyTotalReviews }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="modal-bg fixed inset-0 bg-black bg-opacity-50"></div>
    <div class="bg-gray-800 rounded-lg max-w-md w-full mx-4 z-10 border border-gray-700">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-white">Reject Review</h3>
                <button type="button" onclick="toggleRejectModal()" class="text-gray-400 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            
            <form action="{{ route('admin.reviews.reject', $review->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="rejection_reason" class="block text-sm font-medium text-gray-300 mb-1">Rejection Reason</label>
                    <textarea id="rejection_reason" name="rejection_reason" rows="4" required class="block w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent" placeholder="Explain why this review is being rejected..."></textarea>
                    <p class="mt-1 text-sm text-gray-400">This reason will be shown to the user who submitted the review.</p>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="toggleRejectModal()" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-500">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-500">
                        Reject Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function toggleRejectModal() {
        const modal = document.getElementById('rejectModal');
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        } else {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }
    
    // Close modal when clicking outside
    document.querySelector('.modal-bg').addEventListener('click', function() {
        toggleRejectModal();
    });
</script>
@endsection
