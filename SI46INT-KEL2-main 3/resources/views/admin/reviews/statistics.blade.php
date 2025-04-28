@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white">Review Statistics</h1>
            
            <div class="flex space-x-3">
                <a href="{{ route('admin.reviews.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-sm font-medium text-white hover:bg-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    View All Reviews
                </a>
            </div>
        </div>
        
        <!-- Overview Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Reviews -->
            <div class="bg-gray-700 rounded-lg p-6 border border-gray-600">
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm text-gray-400 mb-1">Total Reviews</p>
                        <h3 class="text-3xl font-bold text-white">{{ $stats['total'] }}</h3>
                    </div>
                    <div class="bg-[#B9FF66] bg-opacity-20 rounded-full h-12 w-12 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-xs">
                        <span class="inline-block px-2 py-0.5 bg-green-500 bg-opacity-20 text-green-300 rounded-full mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span class="text-gray-400">
                            {{ $stats['totalPercentChange'] > 0 ? '+' : '' }}{{ $stats['totalPercentChange'] }}% from last month
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Avg. Rating -->
            <div class="bg-gray-700 rounded-lg p-6 border border-gray-600">
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm text-gray-400 mb-1">Average Rating</p>
                        <h3 class="text-3xl font-bold text-white">{{ number_format($stats['averageRating'], 1) }}</h3>
                    </div>
                    <div class="bg-[#B9FF66] bg-opacity-20 rounded-full h-12 w-12 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-xs">
                        <span class="inline-block px-2 py-0.5 {{ $stats['ratingChange'] >= 0 ? 'bg-green-500 bg-opacity-20 text-green-300' : 'bg-red-500 bg-opacity-20 text-red-300' }} rounded-full mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="{{ $stats['ratingChange'] >= 0 ? 'M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z' : 'M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z' }}" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span class="text-gray-400">
                            {{ $stats['ratingChange'] > 0 ? '+' : '' }}{{ number_format($stats['ratingChange'], 1) }} from last month
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Pending Reviews -->
            <div class="bg-gray-700 rounded-lg p-6 border border-gray-600">
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm text-gray-400 mb-1">Pending Reviews</p>
                        <h3 class="text-3xl font-bold text-white">{{ $stats['pending'] }}</h3>
                    </div>
                    <div class="bg-yellow-500 bg-opacity-20 rounded-full h-12 w-12 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center">
                        <a href="{{ route('admin.reviews.index', ['status' => 'pending']) }}" class="text-[#B9FF66] text-xs hover:underline">
                            View Pending Reviews →
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Monthly Reviews -->
            <div class="bg-gray-700 rounded-lg p-6 border border-gray-600">
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm text-gray-400 mb-1">This Month</p>
                        <h3 class="text-3xl font-bold text-white">{{ $stats['thisMonth'] }}</h3>
                    </div>
                    <div class="bg-blue-500 bg-opacity-20 rounded-full h-12 w-12 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-xs">
                        <span class="inline-block px-2 py-0.5 {{ $stats['monthlyChange'] >= 0 ? 'bg-green-500 bg-opacity-20 text-green-300' : 'bg-red-500 bg-opacity-20 text-red-300' }} rounded-full mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="{{ $stats['monthlyChange'] >= 0 ? 'M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z' : 'M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z' }}" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span class="text-gray-400">
                            {{ $stats['monthlyChange'] > 0 ? '+' : '' }}{{ $stats['monthlyChange'] }}% from last month
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Rating Distribution Chart -->
            <div class="bg-gray-700 rounded-lg p-6 border border-gray-600">
                <h3 class="text-lg font-medium text-white mb-6">Rating Distribution</h3>
                
                <div class="space-y-4">
                    @for($i = 5; $i >= 1; $i--)
                        <div class="flex items-center">
                            <div class="w-10 text-right mr-3 text-gray-300 text-sm">{{ $i }} ★</div>
                            <div class="flex-1 h-6 bg-gray-600 rounded-full overflow-hidden">
                                @php
                                    $percentage = $stats['total'] > 0 ? ($stats['ratingDistribution'][$i] ?? 0) / $stats['total'] * 100 : 0;
                                @endphp
                                <div class="h-full bg-[#B9FF66]" style="width: {{ $percentage }}%"></div>
                            </div>
                            <div class="ml-3 text-gray-300 text-sm w-16">
                                <span class="font-medium">{{ $stats['ratingDistribution'][$i] ?? 0 }}</span>
                                <span class="text-gray-400 text-xs">({{ round($percentage) }}%)</span>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            
            <!-- Top Rated Companies -->
            <div class="bg-gray-700 rounded-lg p-6 border border-gray-600">
                <h3 class="text-lg font-medium text-white mb-6">Top Rated Companies</h3>
                
                @if(count($topCompanies) > 0)
                    <div class="space-y-4">
                        @foreach($topCompanies as $company)
                            <div class="flex items-center justify-between p-3 bg-gray-600 rounded-lg">
                                <div class="flex items-center">
                                    <div class="bg-gray-700 h-10 w-10 rounded-lg flex items-center justify-center text-white font-bold text-lg mr-3">
                                        {{ substr($company->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-white">{{ $company->name }}</p>
                                        <p class="text-xs text-gray-400">{{ $company->review_count }} reviews</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="flex mr-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $i <= $company->average_rating ? 'text-[#B9FF66]' : 'text-gray-500' }}" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="text-sm font-bold text-white">{{ number_format($company->average_rating, 1) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-600 rounded-lg p-6 text-center">
                        <p class="text-gray-400">No companies with approved reviews yet.</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Recent Reviews -->
        <div class="mt-8">
            <h3 class="text-lg font-medium text-white mb-6">Recent Reviews</h3>
            
            @if(count($recentReviews) > 0)
                <div class="bg-gray-700 rounded-lg border border-gray-600 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gray-600">
                                    <th class="py-3 px-4 text-left text-sm font-medium text-white">User</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-white">Company</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-white">Rating</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-white">Status</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-white">Date</th>
                                    <th class="py-3 px-4 text-left text-sm font-medium text-white">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-600">
                                @foreach($recentReviews as $review)
                                <tr class="hover:bg-gray-650">
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
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-sm text-white">{{ $review->employer->name }}</td>
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
                                        <a href="{{ route('admin.reviews.show', $review->id) }}" class="bg-gray-600 hover:bg-gray-500 text-white rounded-md px-3 py-1 text-xs font-medium">
                                            View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="bg-gray-700 rounded-lg p-8 text-center border border-gray-600">
                    <p class="text-gray-400">No reviews found.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
