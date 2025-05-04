<!-- General FAQ Items -->
<div class="space-y-6">
    <!-- Account Management Section -->
    <div class="flex items-center space-x-2 mb-4">
        <div class="w-1 h-6 bg-[#B9FF66] rounded-full"></div>
        <h3 class="text-xl font-semibold text-white">Account Management</h3>
    </div>
    
    <!-- FAQ Item 1 -->
    <div class="bg-gray-800/80 rounded-xl border border-gray-700 overflow-hidden shadow-md transition-all duration-300 hover:shadow-lg hover:border-gray-600" x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left group">
            <div class="flex items-start">
                <div class="bg-gray-700/50 rounded-full p-2 mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h4 class="text-lg font-medium text-white group-hover:text-[#B9FF66] transition-colors">How do I create an account on LokerNow?</h4>
            </div>
            <div class="bg-gray-700/50 rounded-full p-1.5 transition-all duration-300" :class="{'bg-[#B9FF66]/20': open}">
                <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180 text-[#B9FF66]': open}" class="h-5 w-5 text-gray-400 transform transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </button>
        <div x-show="open" x-collapse x-cloak>
            <div class="p-6 border-t border-gray-700 bg-gray-800/50">
                <div class="prose prose-invert max-w-none">
                    <p class="text-gray-300">Creating an account on LokerNow is simple:</p>
                    <ol class="space-y-2 text-gray-300 mt-3">
                        <li class="flex items-start">
                            <span class="bg-[#B9FF66]/20 text-[#B9FF66] rounded-full h-6 w-6 flex items-center justify-center mr-2 font-medium">1</span>
                            <span>Click on the <span class="text-white font-medium">"Sign Up"</span> button in the top right corner of the homepage</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-[#B9FF66]/20 text-[#B9FF66] rounded-full h-6 w-6 flex items-center justify-center mr-2 font-medium">2</span>
                            <span>Enter your email address and create a password</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-[#B9FF66]/20 text-[#B9FF66] rounded-full h-6 w-6 flex items-center justify-center mr-2 font-medium">3</span>
                            <span>Select your account type: <span class="text-white font-medium">Job Seeker</span> or <span class="text-white font-medium">Employer</span></span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-[#B9FF66]/20 text-[#B9FF66] rounded-full h-6 w-6 flex items-center justify-center mr-2 font-medium">4</span>
                            <span>Complete the registration form with your basic information</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-[#B9FF66]/20 text-[#B9FF66] rounded-full h-6 w-6 flex items-center justify-center mr-2 font-medium">5</span>
                            <span>Verify your email address by clicking the link sent to your inbox</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-[#B9FF66]/20 text-[#B9FF66] rounded-full h-6 w-6 flex items-center justify-center mr-2 font-medium">6</span>
                            <span>Log in to start using LokerNow!</span>
                        </li>
                    </ol>
                </div>
                
                <!-- Feedback Buttons -->
                <div class="mt-6 flex items-center justify-between border-t border-gray-700 pt-4">
                    <div class="flex items-center space-x-4">
                        <button @click="$store.faqApp.helpfulVote(1, true)" class="flex items-center text-gray-400 hover:text-[#B9FF66] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span>Helpful</span>
                            <span class="ml-1 bg-gray-700 px-1.5 py-0.5 rounded-md text-xs" id="likes-1">0</span>
                        </button>
                        <button @click="$store.faqApp.helpfulVote(1, false)" class="flex items-center text-gray-400 hover:text-red-400 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2" />
                            </svg>
                            <span>Not Helpful</span>
                            <span class="ml-1 bg-gray-700 px-1.5 py-0.5 rounded-md text-xs" id="dislikes-1">0</span>
                        </button>
                    </div>
                    <div class="text-xs text-gray-500 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Last updated: Jan 15, 2025
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- FAQ Item 2 -->
    <div class="bg-gray-800/80 rounded-xl border border-gray-700 overflow-hidden shadow-md transition-all duration-300 hover:shadow-lg hover:border-gray-600" x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left group">
            <div class="flex items-start">
                <div class="bg-gray-700/50 rounded-full p-2 mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
                <h4 class="text-lg font-medium text-white group-hover:text-[#B9FF66] transition-colors">How do I reset my password?</h4>
            </div>
            <div class="bg-gray-700/50 rounded-full p-1.5 transition-all duration-300" :class="{'bg-[#B9FF66]/20': open}">
                <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180 text-[#B9FF66]': open}" class="h-5 w-5 text-gray-400 transform transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </button>
        <div x-show="open" x-collapse x-cloak>
            <div class="p-6 border-t border-gray-700 bg-gray-800/50">
                <div class="prose prose-invert max-w-none">
                    <p class="text-gray-300">If you've forgotten your password, you can reset it by following these steps:</p>
                    <ol class="space-y-2 text-gray-300 mt-3">
                        <li class="flex items-start">
                            <span class="bg-[#B9FF66]/20 text-[#B9FF66] rounded-full h-6 w-6 flex items-center justify-center mr-2 font-medium">1</span>
                            <span>Click on the <span class="text-white font-medium">"Log In"</span> button in the top right corner</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-[#B9FF66]/20 text-[#B9FF66] rounded-full h-6 w-6 flex items-center justify-center mr-2 font-medium">2</span>
                            <span>Click on the <span class="text-white font-medium">"Forgot Password?"</span> link below the login form</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-[#B9FF66]/20 text-[#B9FF66] rounded-full h-6 w-6 flex items-center justify-center mr-2 font-medium">3</span>
                            <span>Enter the email address associated with your account</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-[#B9FF66]/20 text-[#B9FF66] rounded-full h-6 w-6 flex items-center justify-center mr-2 font-medium">4</span>
                            <span>Check your email for a password reset link</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-[#B9FF66]/20 text-[#B9FF66] rounded-full h-6 w-6 flex items-center justify-center mr-2 font-medium">5</span>
                            <span>Click the link and follow the instructions to create a new password</span>
                        </li>
                    </ol>
                    <div class="bg-blue-900/30 border border-blue-800 rounded-lg p-4 mt-4 flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-blue-300 text-sm m-0">If you don't receive the password reset email within a few minutes, please check your spam folder.</p>
                    </div>
                </div>
                
                <!-- Feedback Buttons -->
                <div class="mt-6 flex items-center justify-between border-t border-gray-700 pt-4">
                    <div class="flex items-center space-x-4">
                        <button @click="$store.faqApp.helpfulVote(2, true)" class="flex items-center text-gray-400 hover:text-[#B9FF66] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span>Helpful</span>
                            <span class="ml-1 bg-gray-700 px-1.5 py-0.5 rounded-md text-xs" id="likes-2">0</span>
                        </button>
                        <button @click="$store.faqApp.helpfulVote(2, false)" class="flex items-center text-gray-400 hover:text-red-400 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2" />
                            </svg>
                            <span>Not Helpful</span>
                            <span class="ml-1 bg-gray-700 px-1.5 py-0.5 rounded-md text-xs" id="dislikes-2">0</span>
                        </button>
                    </div>
                    <div class="text-xs text-gray-500 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Last updated: Jan 15, 2025
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Platform Usage Section -->
    <h3 class="text-lg font-semibold text-[#B9FF66] mt-8 mb-3">Platform Usage</h3>
    
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden" x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left">
            <h4 class="text-lg font-medium text-white">Is LokerNow free to use?</h4>
            <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="h-5 w-5 text-gray-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" x-collapse>
            <div class="p-5 border-t border-gray-700 bg-gray-700">
                <div class="prose prose-invert max-w-none">
                    <p>LokerNow offers both free and premium features:</p>
                    <p><strong>For Job Seekers:</strong></p>
                    <ul>
                        <li>Basic profile creation and management is completely free</li>
                        <li>Job search and application to most positions is free</li>
                        <li>Resume and portfolio uploads are free (with storage limits)</li>
                        <li>Premium features include priority application status, advanced skills assessments, and unlimited portfolio storage</li>
                    </ul>
                    <p><strong>For Employers:</strong></p>
                    <ul>
                        <li>Basic company profile creation is free</li>
                        <li>Limited job postings per month are available on the free tier</li>
                        <li>Premium plans offer additional job postings, featured listings, advanced candidate filtering, and analytics</li>
                    </ul>
                    <p>Visit our <a href="#" class="text-[#B9FF66] hover:underline">Pricing Page</a> for detailed information on our subscription plans.</p>
                </div>
                
                <!-- Feedback Buttons -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="$store.faqApp.helpfulVote(3, true)" class="flex items-center text-gray-400 hover:text-[#B9FF66]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span>Helpful</span>
                            <span class="ml-1" id="likes-3">0</span>
                        </button>
                        <button @click="$store.faqApp.helpfulVote(3, false)" class="flex items-center text-gray-400 hover:text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2" />
                            </svg>
                            <span>Not Helpful</span>
                            <span class="ml-1" id="dislikes-3">0</span>
                        </button>
                    </div>
                    <div class="text-xs text-gray-500">Last updated: April 24, 2025</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden" x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left">
            <h4 class="text-lg font-medium text-white">How can I contact LokerNow support?</h4>
            <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="h-5 w-5 text-gray-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" x-collapse>
            <div class="p-5 border-t border-gray-700 bg-gray-700">
                <div class="prose prose-invert max-w-none">
                    <p>There are several ways to contact our support team:</p>
                    <ul>
                        <li><strong>Email Support:</strong> Send an email to <a href="mailto:support@lokernow.com" class="text-[#B9FF66] hover:underline">support@lokernow.com</a></li>
                        <li><strong>Contact Form:</strong> Fill out the <a href="{{ route('contact') }}" class="text-[#B9FF66] hover:underline">contact form</a> on our website</li>
                        <li><strong>Live Chat:</strong> Use the chat widget in the bottom right corner of any page when logged in</li>
                        <li><strong>Help Center:</strong> Browse our <a href="{{ route('faq.index') }}" class="text-[#B9FF66] hover:underline">help articles</a> for self-service support</li>
                    </ul>
                    <p>Our support team is available Monday through Friday, 9:00 AM to 6:00 PM WIB. We aim to respond to all inquiries within 24 hours during business days.</p>
                </div>
                
                <!-- Feedback Buttons -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="$store.faqApp.helpfulVote(4, true)" class="flex items-center text-gray-400 hover:text-[#B9FF66]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span>Helpful</span>
                            <span class="ml-1" id="likes-4">0</span>
                        </button>
                        <button @click="$store.faqApp.helpfulVote(4, false)" class="flex items-center text-gray-400 hover:text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2" />
                            </svg>
                            <span>Not Helpful</span>
                            <span class="ml-1" id="dislikes-4">0</span>
                        </button>
                    </div>
                    <div class="text-xs text-gray-500">Last updated: April 24, 2025</div>
                </div>
            </div>
        </div>
    </div>
</div>
