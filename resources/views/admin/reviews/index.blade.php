@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold text-white mb-6">Review Moderation</h1>
        
        <!-- Filter Form -->
        <div class="mb-8">
            <form action="{{ route('admin.reviews.index') }}" method="GET" class="bg-gray-700 rounded-lg p-4 border border-gray-600">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                        <select id="status" name="status" class="block w-full bg-gray-800 border border-gray-600 rounded-md py-2 px-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="rating" class="block text-sm font-medium text-gray-300 mb-1">Rating</label>
                        <select id="rating" name="rating" class="block w-full bg-gray-800 border border-gray-600 rounded-md py-2 px-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent">
                            <option value="">All Ratings</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i !== 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>
                    
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-300 mb-1">Search</label>
                        <input type="text" id="search" name="search" placeholder="Search by user, company, or content" value="{{ request('search') }}" class="block w-full bg-gray-800 border border-gray-600 rounded-md py-2 px-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent">
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="bg-[#B9FF66] text-gray-900 px-4 py-2 rounded-md hover:bg-[#a8eb55] font-medium">
                        Filter Results
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Stats Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-gray-700 rounded-lg p-4 flex items-center border border-gray-600">
                <div class="bg-yellow-500 bg-opacity-20 rounded-full p-3 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Pending Reviews</p>
                    <p class="text-xl font-bold text-white">{{ $pendingCount ?? 0 }}</p>
                </div>
            </div>
            
            <div class="bg-gray-700 rounded-lg p-4 flex items-center border border-gray-600">
                <div class="bg-green-500 bg-opacity-20 rounded-full p-3 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Approved Reviews</p>
                    <p class="text-xl font-bold text-white">{{ $approvedCount ?? 0 }}</p>
                </div>
            </div>
            
            <div class="bg-gray-700 rounded-lg p-4 flex items-center border border-gray-600">
                <div class="bg-red-500 bg-opacity-20 rounded-full p-3 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Rejected Reviews</p>
                    <p class="text-xl font-bold text-white">{{ $rejectedCount ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <!-- Reviews Table -->
        @if(count($reviews) > 0)
        <div class="overflow-x-auto mb-6">
            <table class="min-w-full bg-gray-700 border border-gray-600 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-600">
                        <th class="py-3 px-4 text-left text-sm font-medium text-white">ID</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-white">User</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-white">Company</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-white">Rating</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-white">Status</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-white">Date</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-white">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-600">
                    @foreach($reviews as $review)
                    <tr class="hover:bg-gray-650">
                        <td class="py-3 px-4 text-sm text-gray-300">{{ $review->id }}</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-gray-600 flex items-center justify-center text-xs font-medium text-white mr-3">
                                    @if($review->anonymous)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    @else
                                        {{ substr($review->user->name, 0, 1) }}
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-white">
                                        @if($review->anonymous)
                                            Anonymous User
                                        @else
                                            {{ $review->user->name }}
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-400">{{ $review->user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <p class="text-sm font-medium text-white">{{ $review->employer->name }}</p>
                            @if($review->job_title)
                                <p class="text-xs text-gray-400">{{ $review->job_title }}</p>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $i <= $review->rating ? 'text-[#B9FF66]' : 'text-gray-500' }}" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium 
                                @if($review->status === 'pending') bg-yellow-500 bg-opacity-20 text-yellow-300
                                @elseif($review->status === 'approved') bg-green-500 bg-opacity-20 text-green-300
                                @elseif($review->status === 'rejected') bg-red-500 bg-opacity-20 text-red-300
                                @endif">
                                {{ ucfirst($review->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-sm text-gray-300">{{ $review->created_at->format('M d, Y') }}</td>
                        <td class="py-3 px-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.reviews.show', $review->id) }}" class="bg-gray-600 hover:bg-gray-500 text-white rounded-md px-3 py-1 text-xs font-medium">
                                    View
                                </a>
                                
                                @if($review->status === 'pending')
                                <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-green-600 hover:bg-green-500 text-white rounded-md px-3 py-1 text-xs font-medium">
                                        Approve
                                    </button>
                                </form>
                                
                                <a href="#" onclick="toggleRejectModal({{ $review->id }})" class="bg-red-600 hover:bg-red-500 text-white rounded-md px-3 py-1 text-xs font-medium">
                                    Reject
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $reviews->appends(request()->query())->links() }}
        </div>
        
        @else
        <div class="bg-gray-700 rounded-lg p-8 text-center border border-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-gray-300 text-lg mb-2">No reviews found</p>
            <p class="text-gray-400">There are no reviews matching your filters.</p>
        </div>
        @endif
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
            
            <form id="rejectForm" action="" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="rejection_reason" class="block text-sm font-medium text-gray-300 mb-1">Rejection Reason</label>
                    <textarea id="rejection_reason" name="rejection_reason" rows="4" required class="block w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent" placeholder="Explain why this review is being rejected..."></textarea>
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
    function toggleRejectModal(reviewId = null) {
        const modal = document.getElementById('rejectModal');
        
        if (modal.classList.contains('hidden')) {
            if (reviewId) {
                document.getElementById('rejectForm').action = `/admin/reviews/${reviewId}/reject`;
            }
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
