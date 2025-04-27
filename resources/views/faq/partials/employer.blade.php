<!-- Employer FAQ Items -->
<div class="space-y-4">
    <!-- Company Profile Section -->
    <h3 class="text-lg font-semibold text-[#B9FF66] mb-3">Company Profile Management</h3>
    
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden" x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left">
            <h4 class="text-lg font-medium text-white">How do I create and update my company profile?</h4>
            <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="h-5 w-5 text-gray-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" x-collapse>
            <div class="p-5 border-t border-gray-700 bg-gray-700">
                <div class="prose prose-invert max-w-none">
                    <p>To create and update your company profile:</p>
                    <ol>
                        <li>Log in to your LokerNow employer account</li>
                        <li>From your dashboard, click on "Company Profile" in the navigation menu</li>
                        <li>Fill in or update your company information, including:
                            <ul>
                                <li>Company name</li>
                                <li>Industry</li>
                                <li>Company size</li>
                                <li>Location</li>
                                <li>Company description</li>
                                <li>Contact information</li>
                            </ul>
                        </li>
                        <li>Upload your company logo (recommended size: 24px × 24px)</li>
                        <li>Upload a banner image (recommended size: full width with 64px height)</li>
                        <li>Add your company tagline</li>
                        <li>Set your profile visibility (public or private)</li>
                        <li>Click "Save Changes" to update your profile</li>
                    </ol>
                    <p>A complete and professional company profile helps attract quality candidates to your job postings.</p>
                </div>
                
                <!-- Feedback Buttons -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="$store.faqApp.helpfulVote(10, true)" class="flex items-center text-gray-400 hover:text-[#B9FF66]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span>Helpful</span>
                            <span class="ml-1" id="likes-10">0</span>
                        </button>
                        <button @click="$store.faqApp.helpfulVote(10, false)" class="flex items-center text-gray-400 hover:text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2" />
                            </svg>
                            <span>Not Helpful</span>
                            <span class="ml-1" id="dislikes-10">0</span>
                        </button>
                    </div>
                    <div class="text-xs text-gray-500">Last updated: April 24, 2025</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden" x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left">
            <h4 class="text-lg font-medium text-white">How do I add employee testimonials to my company profile?</h4>
            <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="h-5 w-5 text-gray-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" x-collapse>
            <div class="p-5 border-t border-gray-700 bg-gray-700">
                <div class="prose prose-invert max-w-none">
                    <p>Employee testimonials can help showcase your company culture and attract top talent. To add testimonials:</p>
                    <ol>
                        <li>Log in to your LokerNow employer account</li>
                        <li>Navigate to "Company Profile" in the dashboard menu</li>
                        <li>Scroll down to the "Employee Testimonials" section</li>
                        <li>Click on "Add Testimonial"</li>
                        <li>Fill in the following information:
                            <ul>
                                <li>Employee name</li>
                                <li>Employee position</li>
                                <li>Testimonial text</li>
                                <li>Optional: Upload employee photo</li>
                            </ul>
                        </li>
                        <li>Click "Save Testimonial"</li>
                    </ol>
                    <p>You can add multiple testimonials and rearrange their order by dragging and dropping. Testimonials will be displayed on your public company profile to give job seekers insight into your workplace culture.</p>
                </div>
                
                <!-- Feedback Buttons -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="$store.faqApp.helpfulVote(11, true)" class="flex items-center text-gray-400 hover:text-[#B9FF66]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span>Helpful</span>
                            <span class="ml-1" id="likes-11">0</span>
                        </button>
                        <button @click="$store.faqApp.helpfulVote(11, false)" class="flex items-center text-gray-400 hover:text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2" />
                            </svg>
                            <span>Not Helpful</span>
                            <span class="ml-1" id="dislikes-11">0</span>
                        </button>
                    </div>
                    <div class="text-xs text-gray-500">Last updated: April 24, 2025</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Job Posting Section -->
    <h3 class="text-lg font-semibold text-[#B9FF66] mt-8 mb-3">Job Posting & Management</h3>
    
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden" x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left">
            <h4 class="text-lg font-medium text-white">How do I post a new job?</h4>
            <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="h-5 w-5 text-gray-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" x-collapse>
            <div class="p-5 border-t border-gray-700 bg-gray-700">
                <div class="prose prose-invert max-w-none">
                    <p>To post a new job on LokerNow:</p>
                    <ol>
                        <li>Log in to your LokerNow employer account</li>
                        <li>From your dashboard, click on "Manage Jobs" in the navigation menu</li>
                        <li>Click the "Post New Job" button</li>
                        <li>Fill in the job details:
                            <ul>
                                <li>Job title</li>
                                <li>Job description</li>
                                <li>Job requirements</li>
                                <li>Job type (Full-time, Part-time, Contract, etc.)</li>
                                <li>Location (On-site, Remote, Hybrid)</li>
                                <li>Salary range</li>
                                <li>Application deadline</li>
                                <li>Required skills</li>
                                <li>Required experience level</li>
                            </ul>
                        </li>
                        <li>Set application preferences (e.g., require cover letter, ask screening questions)</li>
                        <li>Link the job to your hiring schedule (if you have one set up)</li>
                        <li>Preview the job posting</li>
                        <li>Click "Publish Job" to make it live</li>
                    </ol>
                    <p>Your job posting will be immediately visible to job seekers after publishing. You can edit or remove the posting at any time from the "Manage Jobs" section.</p>
                </div>
                
                <!-- Feedback Buttons -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="$store.faqApp.helpfulVote(12, true)" class="flex items-center text-gray-400 hover:text-[#B9FF66]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span>Helpful</span>
                            <span class="ml-1" id="likes-12">0</span>
                        </button>
                        <button @click="$store.faqApp.helpfulVote(12, false)" class="flex items-center text-gray-400 hover:text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2" />
                            </svg>
                            <span>Not Helpful</span>
                            <span class="ml-1" id="dislikes-12">0</span>
                        </button>
                    </div>
                    <div class="text-xs text-gray-500">Last updated: April 24, 2025</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Application Management Section -->
    <h3 class="text-lg font-semibold text-[#B9FF66] mt-8 mb-3">Application Management</h3>
    
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden" x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left">
            <h4 class="text-lg font-medium text-white">How do I review and manage job applications?</h4>
            <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="h-5 w-5 text-gray-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" x-collapse>
            <div class="p-5 border-t border-gray-700 bg-gray-700">
                <div class="prose prose-invert max-w-none">
                    <p>To review and manage job applications:</p>
                    <ol>
                        <li>Log in to your LokerNow employer account</li>
                        <li>From your dashboard, click on "View Applications" in the navigation menu</li>
                        <li>You'll see a list of all applications across your job postings</li>
                        <li>You can filter applications by:
                            <ul>
                                <li>Job title</li>
                                <li>Application status</li>
                                <li>Date received</li>
                                <li>Candidate skills</li>
                            </ul>
                        </li>
                        <li>Click on an application to view the full details, including:
                            <ul>
                                <li>Candidate's profile</li>
                                <li>Resume/CV</li>
                                <li>Cover letter</li>
                                <li>Answers to screening questions</li>
                                <li>Portfolio (if provided)</li>
                            </ul>
                        </li>
                        <li>Update the application status using the dropdown menu:
                            <ul>
                                <li>Pending → Reviewing → Shortlisted → Accepted/Rejected</li>
                            </ul>
                        </li>
                        <li>Add notes about the candidate for your reference</li>
                        <li>Contact the candidate directly through the messaging system</li>
                    </ol>
                    <p>When you update an application's status, the candidate will receive a notification about the change.</p>
                </div>
                
                <!-- Feedback Buttons -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="$store.faqApp.helpfulVote(13, true)" class="flex items-center text-gray-400 hover:text-[#B9FF66]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span>Helpful</span>
                            <span class="ml-1" id="likes-13">0</span>
                        </button>
                        <button @click="$store.faqApp.helpfulVote(13, false)" class="flex items-center text-gray-400 hover:text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2" />
                            </svg>
                            <span>Not Helpful</span>
                            <span class="ml-1" id="dislikes-13">0</span>
                        </button>
                    </div>
                    <div class="text-xs text-gray-500">Last updated: April 24, 2025</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden" x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left">
            <h4 class="text-lg font-medium text-white">How do I set up my hiring schedule?</h4>
            <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="h-5 w-5 text-gray-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" x-collapse>
            <div class="p-5 border-t border-gray-700 bg-gray-700">
                <div class="prose prose-invert max-w-none">
                    <p>The hiring schedule feature helps you plan your hiring workflow and keeps candidates informed about your timeline. To set up your schedule:</p>
                    <ol>
                        <li>Log in to your LokerNow employer account</li>
                        <li>From your dashboard, click on "Schedule Manager" in the navigation menu</li>
                        <li>You'll see a weekly calendar grid</li>
                        <li>For each day of the week, you can set a status:
                            <ul>
                                <li>"Accepting Applications" - Days when new applications are being accepted</li>
                                <li>"Review Day" - Days when you review applications</li>
                                <li>"Interview Slots" - Days when you conduct interviews</li>
                                <li>"Off" - Days when you're not actively working on hiring</li>
                            </ul>
                        </li>
                        <li>You can either:
                            <ul>
                                <li>Click on each day and select a status from the dropdown menu</li>
                                <li>Use the drag-and-drop feature to assign statuses to multiple days</li>
                            </ul>
                        </li>
                        <li>Click "Save Schedule" when you're done</li>
                    </ol>
                    <p>When creating or editing job postings, you can link them to your schedule. This will automatically show or hide job listings based on your "Accepting Applications" days and display your hiring timeline to candidates.</p>
                </div>
                
                <!-- Feedback Buttons -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="$store.faqApp.helpfulVote(14, true)" class="flex items-center text-gray-400 hover:text-[#B9FF66]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span>Helpful</span>
                            <span class="ml-1" id="likes-14">0</span>
                        </button>
                        <button @click="$store.faqApp.helpfulVote(14, false)" class="flex items-center text-gray-400 hover:text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2" />
                            </svg>
                            <span>Not Helpful</span>
                            <span class="ml-1" id="dislikes-14">0</span>
                        </button>
                    </div>
                    <div class="text-xs text-gray-500">Last updated: April 24, 2025</div>
                </div>
            </div>
        </div>
    </div>
</div>
