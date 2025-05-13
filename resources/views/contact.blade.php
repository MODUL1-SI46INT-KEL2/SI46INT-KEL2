@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <!-- Header Section -->
        <div class="bg-gray-800 rounded-lg shadow-lg p-8 mb-8 border-l-4 border-[#B9FF66] text-center">
            <h1 class="text-3xl font-bold text-white mb-4">Contact Support</h1>
            <p class="text-gray-300 text-lg mb-6">Have questions or need assistance? We're here to help!</p>
        </div>
        
        <!-- Contact Form -->
        <div class="bg-gray-800 rounded-lg shadow-lg p-8 border border-gray-700">
            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Your Name</label>
                    <input type="text" id="name" name="name" 
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg py-3 px-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent"
                           placeholder="Enter your name" required>
                </div>
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                    <input type="email" id="email" name="email" 
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg py-3 px-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent"
                           placeholder="Enter your email" required>
                </div>
                
                <!-- Subject Field -->
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-300 mb-2">Subject</label>
                    <input type="text" id="subject" name="subject" 
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg py-3 px-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent"
                           placeholder="What is your inquiry about?" required>
                </div>
                
                <!-- Message Field -->
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-300 mb-2">Message</label>
                    <textarea id="message" name="message" rows="6" 
                              class="w-full bg-gray-700 border border-gray-600 rounded-lg py-3 px-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent"
                              placeholder="Please describe your issue or question in detail" required></textarea>
                </div>
                
                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="bg-[#B9FF66] hover:bg-[#a8eb55] text-gray-900 font-medium py-3 px-6 rounded-md transition-colors">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Alternative Contact Methods -->
        <div class="mt-8 bg-gray-800 rounded-lg shadow-lg p-6 border border-gray-700">
            <h3 class="text-xl font-semibold text-white mb-4">Other Ways to Reach Us</h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Email -->
                <div class="flex items-start space-x-4">
                    <div class="bg-gray-700 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-white font-medium">Email Us</h4>
                        <p class="text-gray-400 mt-1">support@lokernow.com</p>
                        <p class="text-gray-500 text-sm mt-1">We'll respond within 24 hours</p>
                    </div>
                </div>
                
                <!-- Phone -->
                <div class="flex items-start space-x-4">
                    <div class="bg-gray-700 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-white font-medium">Call Us</h4>
                        <p class="text-gray-400 mt-1">+62 21 1234 5678</p>
                        <p class="text-gray-500 text-sm mt-1">Mon-Fri, 9am-5pm WIB</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
