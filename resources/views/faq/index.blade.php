@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl shadow-xl p-10 mb-10 border-l-4 border-[#B9FF66] text-center">
            <h1 class="text-4xl font-bold text-white mb-4">Frequently Asked Questions</h1>
            <p class="text-gray-300 text-lg mb-8">Find answers to common questions about using LokerNow</p>
            
            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto">
                <div class="relative group">
                    <input type="text" id="faq-search" 
                           class="w-full bg-gray-700/70 backdrop-blur border border-gray-600 rounded-lg py-4 px-5 pl-14 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent transition-all duration-300 shadow-md"
                           placeholder="Search for questions...">
                    <div class="absolute left-5 top-4 text-gray-400 group-focus-within:text-[#B9FF66] transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-gray-400 text-sm mt-3">Try searching for "account", "password", or "pricing"</p>
            </div>
        </div>
        
        <!-- Category Tabs -->
        <div class="mb-10" x-data="{ activeTab: 'general' }">
            <div class="flex flex-wrap justify-center border-b border-gray-700 mb-8">
                <button @click="activeTab = 'general'" 
                        :class="{ 'border-[#B9FF66] text-white': activeTab === 'general', 'border-transparent text-gray-400 hover:text-gray-300': activeTab !== 'general' }"
                        class="px-8 py-4 font-medium text-base border-b-2 -mb-px transition-colors">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        General
                    </div>
                </button>
                <button @click="activeTab = 'jobseeker'" 
                        :class="{ 'border-[#B9FF66] text-white': activeTab === 'jobseeker', 'border-transparent text-gray-400 hover:text-gray-300': activeTab !== 'jobseeker' }"
                        class="px-8 py-4 font-medium text-base border-b-2 -mb-px transition-colors">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        For Job Seekers
                    </div>
                </button>
                <button @click="activeTab = 'employer'" 
                        :class="{ 'border-[#B9FF66] text-white': activeTab === 'employer', 'border-transparent text-gray-400 hover:text-gray-300': activeTab !== 'employer' }"
                        class="px-8 py-4 font-medium text-base border-b-2 -mb-px transition-colors">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        For Employers
                    </div>
                </button>
            </div>
            
            <!-- General FAQs -->
            <div x-show="activeTab === 'general'" class="space-y-6 bg-gray-800/50 p-6 rounded-xl">
                <div class="flex items-center space-x-3 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h2 class="text-2xl font-semibold text-white">General Questions</h2>
                </div>
                
                @include('faq.partials.general')
            </div>
            
            <!-- Job Seeker FAQs -->
            <div x-show="activeTab === 'jobseeker'" class="space-y-6 bg-gray-800/50 p-6 rounded-xl" x-cloak>
                <div class="flex items-center space-x-3 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <h2 class="text-2xl font-semibold text-white">Job Seeker Questions</h2>
                </div>
                
                @include('faq.partials.jobseeker')
            </div>
            
            <!-- Employer FAQs -->
            <div x-show="activeTab === 'employer'" class="space-y-6 bg-gray-800/50 p-6 rounded-xl" x-cloak>
                <div class="flex items-center space-x-3 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <h2 class="text-2xl font-semibold text-white">Employer Questions</h2>
                </div>
                
                @include('faq.partials.employer')
            </div>
        </div>
        
        <!-- Contact Support Section -->
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl shadow-xl p-8 border border-gray-700 mt-12">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="text-left mb-6 md:mb-0">
                    <h3 class="text-2xl font-semibold text-white mb-2">Couldn't find what you're looking for?</h3>
                    <p class="text-gray-300">Our support team is here to help you with any questions you may have.</p>
                </div>
                <a href="{{ route('contact') }}" class="inline-flex items-center bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-medium py-3 px-8 rounded-lg transition-colors shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    Contact Support
                </a>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Item Template -->
<template id="faq-item-template">
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden" x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left">
            <h3 class="text-lg font-medium text-white" x-text="question"></h3>
            <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="h-5 w-5 text-gray-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" x-collapse>
            <div class="p-5 border-t border-gray-700 bg-gray-800">
                <div class="prose prose-invert max-w-none" x-html="answer"></div>
                
                <!-- Feedback Buttons -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="helpfulVote(id, true)" class="flex items-center text-gray-400 hover:text-[#B9FF66]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span>Helpful</span>
                            <span class="ml-1" x-text="likes"></span>
                        </button>
                        <button @click="helpfulVote(id, false)" class="flex items-center text-gray-400 hover:text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2" />
                            </svg>
                            <span>Not Helpful</span>
                            <span class="ml-1" x-text="dislikes"></span>
                        </button>
                    </div>
                    <div class="text-xs text-gray-500">Last updated: <span x-text="updated"></span></div>
                </div>
            </div>
        </div>
    </div>
</template>
@endsection

@section('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('faqApp', () => ({
            faqItems: [],
            filteredItems: [],
            searchQuery: '',
            
            init() {
                // Fetch FAQ items from API
                this.fetchFAQs();
                
                // Setup search functionality
                const searchInput = document.getElementById('faq-search');
                searchInput.addEventListener('input', (e) => {
                    this.searchQuery = e.target.value.toLowerCase();
                    this.filterItems();
                });
            },
            
            fetchFAQs() {
                // In a real app, this would be an API call
                // For now, we'll use dummy data
                this.faqItems = [
                    // Data will be populated from the partials
                ];
                this.filteredItems = this.faqItems;
            },
            
            filterItems() {
                if (!this.searchQuery) {
                    this.filteredItems = this.faqItems;
                    return;
                }
                
                this.filteredItems = this.faqItems.filter(item => 
                    item.question.toLowerCase().includes(this.searchQuery) || 
                    item.answer.toLowerCase().includes(this.searchQuery)
                );
            },
            
            helpfulVote(id, isHelpful) {
                // In a real app, this would be an API call
                console.log(`FAQ ${id} voted as ${isHelpful ? 'helpful' : 'not helpful'}`);
                
                // For demo purposes, we'll just update the local state
                const item = this.faqItems.find(item => item.id === id);
                if (item) {
                    if (isHelpful) {
                        item.likes++;
                    } else {
                        item.dislikes++;
                    }
                }
                
                // Show a thank you message
                alert('Thank you for your feedback!');
            }
        }));
    });
</script>
@endsection
