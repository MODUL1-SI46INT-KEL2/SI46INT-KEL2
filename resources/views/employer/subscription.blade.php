@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl shadow-xl p-8 mb-10 border-l-4 border-[#B9FF66]">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Subscription Management</h1>
                    <p class="text-gray-300">Manage your LokerNow subscription and features</p>
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

        <!-- Current Plan Section -->
        <div class="bg-gray-800/80 rounded-xl shadow-lg p-8 border border-gray-700 mb-8">
            <h2 class="text-xl font-bold text-white mb-6">Current Plan Details</h2>
            
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <div class="bg-gray-700/30 rounded-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-white">Professional Plan</h3>
                            <span class="px-3 py-1 rounded-full bg-[#B9FF66] text-gray-900 text-sm font-medium">Active</span>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-gray-400 text-sm">Billing Cycle</p>
                                <p class="text-white">Monthly (Next billing: May 25, 2025)</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 text-sm">Amount</p>
                                <p class="text-white">Rp 999,000 / month</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 text-sm">Payment Method</p>
                                <p class="text-white">Visa ending in 4242</p>
                            </div>
                        </div>
                        
                        <div class="mt-6 flex flex-wrap gap-3">
                            <button class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg text-sm transition-colors">
                                Change Plan
                            </button>
                            <button class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg text-sm transition-colors">
                                Update Payment
                            </button>
                            <button class="px-4 py-2 bg-red-900/50 hover:bg-red-900 text-red-300 rounded-lg text-sm transition-colors">
                                Cancel Subscription
                            </button>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="bg-gray-700/30 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-white mb-4">Usage Summary</h3>
                        
                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-gray-300">Job Postings</span>
                                    <span class="text-gray-300">8 / 15</span>
                                </div>
                                <div class="w-full bg-gray-700 rounded-full h-2.5">
                                    <div class="bg-[#B9FF66] h-2.5 rounded-full" style="width: 53%"></div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-gray-300">Featured Listings</span>
                                    <span class="text-gray-300">3 / 5</span>
                                </div>
                                <div class="w-full bg-gray-700 rounded-full h-2.5">
                                    <div class="bg-[#B9FF66] h-2.5 rounded-full" style="width: 60%"></div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-gray-300">Days Remaining</span>
                                    <span class="text-gray-300">20 / 30</span>
                                </div>
                                <div class="w-full bg-gray-700 rounded-full h-2.5">
                                    <div class="bg-[#B9FF66] h-2.5 rounded-full" style="width: 67%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Plan Comparison -->
        <div class="bg-gray-800/80 rounded-xl shadow-lg p-8 border border-gray-700 mb-8">
            <h2 class="text-xl font-bold text-white mb-6">Available Plans</h2>
            
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Basic Plan -->
                <div class="bg-gray-700/30 rounded-lg p-6 border border-gray-700 transition-all duration-300 hover:border-gray-500">
                    <h3 class="text-lg font-medium text-white mb-2">Basic</h3>
                    <p class="text-2xl font-bold text-white mb-4">Rp 499k <span class="text-gray-400 text-sm font-normal">/month</span></p>
                    
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300 text-sm">5 job postings</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300 text-sm">30-day listings</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300 text-sm">Basic analytics</span>
                        </li>
                    </ul>
                    
                    <button class="w-full px-4 py-2 bg-gray-600 hover:bg-gray-500 text-white rounded-lg text-sm transition-colors">
                        Downgrade
                    </button>
                </div>
                
                <!-- Professional Plan -->
                <div class="bg-gradient-to-b from-gray-700/30 to-gray-800/60 rounded-lg p-6 border-2 border-[#B9FF66] shadow-lg relative">
                    <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-[#B9FF66] text-gray-900 text-xs font-bold px-3 py-1 rounded-full">
                        CURRENT PLAN
                    </div>
                    
                    <h3 class="text-lg font-medium text-white mb-2">Professional</h3>
                    <p class="text-2xl font-bold text-white mb-4">Rp 999k <span class="text-gray-400 text-sm font-normal">/month</span></p>
                    
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-white text-sm">15 job postings</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-white text-sm">5 featured listings</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-white text-sm">60-day listings</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-white text-sm">Advanced analytics</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Enterprise Plan -->
                <div class="bg-gray-700/30 rounded-lg p-6 border border-gray-700 transition-all duration-300 hover:border-gray-500">
                    <h3 class="text-lg font-medium text-white mb-2">Enterprise</h3>
                    <p class="text-2xl font-bold text-white mb-4">Rp 1,999k <span class="text-gray-400 text-sm font-normal">/month</span></p>
                    
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300 text-sm">Unlimited job postings</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300 text-sm">Unlimited featured listings</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300 text-sm">90-day listings</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300 text-sm">Premium analytics</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300 text-sm">Dedicated account manager</span>
                        </li>
                    </ul>
                    
                    <button class="w-full px-4 py-2 bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 rounded-lg text-sm font-medium transition-colors">
                        Upgrade
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Billing History -->
        <div class="bg-gray-800/80 rounded-xl shadow-lg p-8 border border-gray-700">
            <h2 class="text-xl font-bold text-white mb-6">Billing History</h2>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="py-3 px-4 text-left text-gray-300 font-medium">Date</th>
                            <th class="py-3 px-4 text-left text-gray-300 font-medium">Description</th>
                            <th class="py-3 px-4 text-left text-gray-300 font-medium">Amount</th>
                            <th class="py-3 px-4 text-left text-gray-300 font-medium">Status</th>
                            <th class="py-3 px-4 text-left text-gray-300 font-medium">Invoice</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-700">
                            <td class="py-3 px-4 text-gray-300">Apr 25, 2025</td>
                            <td class="py-3 px-4 text-gray-300">Professional Plan - Monthly</td>
                            <td class="py-3 px-4 text-gray-300">Rp 999,000</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 rounded-full bg-green-900/30 text-green-400 text-xs font-medium">Paid</span>
                            </td>
                            <td class="py-3 px-4">
                                <a href="#" class="text-[#B9FF66] hover:underline text-sm">Download</a>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-700">
                            <td class="py-3 px-4 text-gray-300">Mar 25, 2025</td>
                            <td class="py-3 px-4 text-gray-300">Professional Plan - Monthly</td>
                            <td class="py-3 px-4 text-gray-300">Rp 999,000</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 rounded-full bg-green-900/30 text-green-400 text-xs font-medium">Paid</span>
                            </td>
                            <td class="py-3 px-4">
                                <a href="#" class="text-[#B9FF66] hover:underline text-sm">Download</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-gray-300">Feb 25, 2025</td>
                            <td class="py-3 px-4 text-gray-300">Basic Plan - Monthly</td>
                            <td class="py-3 px-4 text-gray-300">Rp 499,000</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 rounded-full bg-green-900/30 text-green-400 text-xs font-medium">Paid</span>
                            </td>
                            <td class="py-3 px-4">
                                <a href="#" class="text-[#B9FF66] hover:underline text-sm">Download</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
