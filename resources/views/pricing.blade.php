@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl shadow-xl p-10 mb-10 border-l-4 border-[#B9FF66] text-center">
            <h1 class="text-4xl font-bold text-white mb-4">Pricing Plans</h1>
            <p class="text-gray-300 text-lg mb-6">Choose the right plan for your hiring needs</p>
            
            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <button class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:ring-offset-2 focus:ring-offset-gray-900">Monthly Billing</button>
                <button class="bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 px-6 py-3 rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:ring-offset-2 focus:ring-offset-gray-900">
                    Annual Billing
                    <span class="ml-2 bg-gray-900 text-[#B9FF66] text-xs px-2 py-1 rounded-full">Save 15%</span>
                </button>
            </div>
        </div>
        
        <!-- Pricing Cards -->
        <div class="grid md:grid-cols-3 gap-8 mb-12">
            <!-- Basic Plan -->
            <div class="bg-gray-800/80 rounded-xl shadow-lg overflow-hidden border border-gray-700 transition-all duration-300 hover:shadow-xl hover:transform hover:scale-[1.02] group">
                <div class="p-6 border-b border-gray-700">
                    <div class="bg-gray-700/50 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Basic</h3>
                    <div class="flex items-baseline mb-4">
                        <span class="text-3xl font-bold text-white">Rp 499k</span>
                        <span class="text-gray-400 ml-2">/month</span>
                    </div>
                    <p class="text-gray-300">Perfect for small businesses just getting started</p>
                </div>
                <div class="p-6">
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300">Post up to 5 jobs</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300">Basic company profile</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300">Email support</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300">30-day job listings</span>
                        </li>
                    </ul>
                    <div class="mt-6">
                        <a href="#" class="block w-full bg-gray-700 hover:bg-gray-600 text-white text-center py-3 rounded-lg font-medium transition-colors group-hover:bg-[#B9FF66] group-hover:text-gray-900">
                            Get Started
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Professional Plan -->
            <div class="bg-gray-800/80 rounded-xl shadow-xl overflow-hidden border-2 border-[#B9FF66] transform scale-105 z-10">
                <div class="bg-[#B9FF66] text-gray-900 text-center py-1.5 text-sm font-medium">
                    MOST POPULAR
                </div>
                <div class="p-6 border-b border-gray-700">
                    <div class="bg-[#B9FF66]/20 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Professional</h3>
                    <div class="flex items-baseline mb-4">
                        <span class="text-3xl font-bold text-white">Rp 999k</span>
                        <span class="text-gray-400 ml-2">/month</span>
                    </div>
                    <p class="text-gray-300">Ideal for growing companies with regular hiring needs</p>
                </div>
                <div class="p-6">
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300">Post up to 15 jobs</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300">Enhanced company profile</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300">Priority email & phone support</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300">60-day job listings</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300">Featured listings (5 per month)</span>
                        </li>
                    </ul>
                    <div class="mt-6">
                        <a href="#" class="block w-full bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 text-center py-3 rounded-lg font-medium transition-colors">
                            Get Started
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Enterprise Plan -->
            <div class="bg-gray-800/80 rounded-xl shadow-lg overflow-hidden border border-gray-700 transition-all duration-300 hover:shadow-xl hover:transform hover:scale-[1.02] group">
                <div class="p-6 border-b border-gray-700">
                    <div class="bg-gray-700/50 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Enterprise</h3>
                    <div class="flex items-baseline mb-4">
                        <span class="text-3xl font-bold text-white">Rp 1,999k</span>
                        <span class="text-gray-400 ml-2">/month</span>
                    </div>
                    <p class="text-gray-300">For large organizations with high-volume recruiting</p>
                </div>
                <div class="p-6">
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300">Unlimited job postings</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300">Premium company profile</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300">Dedicated account manager</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300">90-day job listings</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-[#B9FF66] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-300">Featured listings (unlimited)</span>
                        </li>
                    </ul>
                    <div class="mt-6">
                        <a href="#" class="block w-full bg-gray-700 hover:bg-gray-600 text-white text-center py-3 rounded-lg font-medium transition-colors group-hover:bg-[#B9FF66] group-hover:text-gray-900">
                            Contact Sales
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Feature Comparison -->
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl shadow-xl p-8 mb-12">
            <h2 class="text-2xl font-bold text-white mb-6 text-center">Feature Comparison</h2>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="py-4 px-6 text-left text-gray-300 font-medium">Feature</th>
                            <th class="py-4 px-6 text-center text-gray-300 font-medium">Basic</th>
                            <th class="py-4 px-6 text-center text-[#B9FF66] font-medium">Professional</th>
                            <th class="py-4 px-6 text-center text-gray-300 font-medium">Enterprise</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-700">
                            <td class="py-4 px-6 text-white">Job Postings</td>
                            <td class="py-4 px-6 text-center text-gray-300">5</td>
                            <td class="py-4 px-6 text-center text-white">15</td>
                            <td class="py-4 px-6 text-center text-gray-300">Unlimited</td>
                        </tr>
                        <tr class="border-b border-gray-700">
                            <td class="py-4 px-6 text-white">Featured Listings</td>
                            <td class="py-4 px-6 text-center text-gray-300">-</td>
                            <td class="py-4 px-6 text-center text-white">5 per month</td>
                            <td class="py-4 px-6 text-center text-gray-300">Unlimited</td>
                        </tr>
                        <tr class="border-b border-gray-700">
                            <td class="py-4 px-6 text-white">Job Listing Duration</td>
                            <td class="py-4 px-6 text-center text-gray-300">30 days</td>
                            <td class="py-4 px-6 text-center text-white">60 days</td>
                            <td class="py-4 px-6 text-center text-gray-300">90 days</td>
                        </tr>
                        <tr class="border-b border-gray-700">
                            <td class="py-4 px-6 text-white">Candidate Filtering</td>
                            <td class="py-4 px-6 text-center text-gray-300">Basic</td>
                            <td class="py-4 px-6 text-center text-white">Advanced</td>
                            <td class="py-4 px-6 text-center text-gray-300">Premium</td>
                        </tr>
                        <tr class="border-b border-gray-700">
                            <td class="py-4 px-6 text-white">Analytics Dashboard</td>
                            <td class="py-4 px-6 text-center text-gray-300">
                                <svg class="h-5 w-5 text-red-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </td>
                            <td class="py-4 px-6 text-center text-white">
                                <svg class="h-5 w-5 text-[#B9FF66] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </td>
                            <td class="py-4 px-6 text-center text-gray-300">
                                <svg class="h-5 w-5 text-[#B9FF66] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 text-white">Dedicated Account Manager</td>
                            <td class="py-4 px-6 text-center text-gray-300">
                                <svg class="h-5 w-5 text-red-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </td>
                            <td class="py-4 px-6 text-center text-white">
                                <svg class="h-5 w-5 text-red-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </td>
                            <td class="py-4 px-6 text-center text-gray-300">
                                <svg class="h-5 w-5 text-[#B9FF66] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- FAQ Section -->
        <div class="bg-gray-800/80 rounded-xl shadow-lg p-8 border border-gray-700 mb-12">
            <h2 class="text-2xl font-bold text-white mb-6 text-center">Frequently Asked Questions</h2>
            
            <div class="space-y-4 max-w-3xl mx-auto" x-data="{selected:null}">
                <!-- FAQ Item 1 -->
                <div class="border border-gray-700 rounded-lg overflow-hidden" x-data="{open:false}">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-4 text-left bg-gray-700/50 hover:bg-gray-700 transition-colors">
                        <span class="text-white font-medium">Can I change plans later?</span>
                        <svg class="h-5 w-5 text-gray-400" :class="{'transform rotate-180 text-[#B9FF66]': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse x-cloak>
                        <div class="p-4 bg-gray-800/50">
                            <p class="text-gray-300">Yes, you can upgrade or downgrade your plan at any time. Changes to your subscription will be prorated and reflected in your next billing cycle.</p>
                        </div>
                    </div>
                </div>
                
                <!-- FAQ Item 2 -->
                <div class="border border-gray-700 rounded-lg overflow-hidden" x-data="{open:false}">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-4 text-left bg-gray-700/50 hover:bg-gray-700 transition-colors">
                        <span class="text-white font-medium">Do you offer discounts for annual billing?</span>
                        <svg class="h-5 w-5 text-gray-400" :class="{'transform rotate-180 text-[#B9FF66]': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse x-cloak>
                        <div class="p-4 bg-gray-800/50">
                            <p class="text-gray-300">Yes, we offer a 15% discount when you choose annual billing for any of our plans. This option is available during checkout.</p>
                        </div>
                    </div>
                </div>
                
                <!-- FAQ Item 3 -->
                <div class="border border-gray-700 rounded-lg overflow-hidden" x-data="{open:false}">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-4 text-left bg-gray-700/50 hover:bg-gray-700 transition-colors">
                        <span class="text-white font-medium">What payment methods do you accept?</span>
                        <svg class="h-5 w-5 text-gray-400" :class="{'transform rotate-180 text-[#B9FF66]': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse x-cloak>
                        <div class="p-4 bg-gray-800/50">
                            <p class="text-gray-300">We accept all major credit cards (Visa, Mastercard, American Express), PayPal, and bank transfers for annual plans. For Indonesian customers, we also support payments via BCA, Mandiri, and BNI.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl shadow-xl p-8 border border-gray-700">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="text-left mb-6 md:mb-0">
                    <h2 class="text-2xl font-bold text-white mb-2">Ready to find the perfect candidates?</h2>
                    <p class="text-gray-300">Join thousands of companies that use LokerNow to build their teams with top talent.</p>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="#" class="inline-flex items-center bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-medium py-3 px-8 rounded-lg transition-colors shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Start Free Trial
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center bg-gray-700 hover:bg-gray-600 text-white font-medium py-3 px-8 rounded-lg transition-colors shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        Contact Sales
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
