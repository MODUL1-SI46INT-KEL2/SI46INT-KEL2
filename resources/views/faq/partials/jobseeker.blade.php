<!-- Job Seeker FAQ Items -->
<div class="space-y-4">
    <!-- Profile Management Section -->
    <h3 class="text-lg font-semibold text-[#B9FF66] mb-3">Profile Management</h3>
    
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden" x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left">
            <h4 class="text-lg font-medium text-white">How do I create and update my job seeker profile?</h4>
            <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="h-5 w-5 text-gray-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" x-collapse>
            <div class="p-5 border-t border-gray-700 bg-gray-700">
                <div class="prose prose-invert max-w-none">
                    <p>To create and update your job seeker profile:</p>
                    <ol>
                        <li>Log in to your LokerNow account</li>
                        <li>Click on your account icon in the top right corner</li>
                        <li>Select "My Profile" from the dropdown menu</li>
                        <li>On your profile page, click the "Edit Profile" button</li>
                        <li>Fill in or update your personal information, including:
                            <ul>
                                <li>Contact details</li>
                                <li>Career summary</li>
                                <li>Education history</li>
                                <li>Work experience</li>
                                <li>Skills</li>
                            </ul>
                        </li>
                        <li>Click "Save Changes" to update your profile</li>
                    </ol>
                    <p>Remember to keep your profile up-to-date to increase your chances of being noticed by employers.</p>
                </div>
                
                <!-- Feedback Buttons -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="$store.faqApp.helpfulVote(5, true)" class="flex items-center text-gray-400 hover:text-[#B9FF66]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span>Helpful</span>
                            <span class="ml-1" id="likes-5">0</span>
                        </button>
                        <button @click="$store.faqApp.helpfulVote(5, false)" class="flex items-center text-gray-400 hover:text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2" />
                            </svg>
                            <span>Not Helpful</span>
                            <span class="ml-1" id="dislikes-5">0</span>
                        </button>
                    </div>
                    <div class="text-xs text-gray-500">Last updated: April 24, 2025</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden" x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left">
            <h4 class="text-lg font-medium text-white">How do I upload my resume and portfolio?</h4>
            <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="h-5 w-5 text-gray-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" x-collapse>
            <div class="p-5 border-t border-gray-700 bg-gray-700">
                <div class="prose prose-invert max-w-none">
                    <p>To upload your resume and portfolio:</p>
                    
                    <h5>Resume Upload:</h5>
                    <ol>
                        <li>Log in to your LokerNow account</li>
                        <li>Click on your account icon and select "My Profile"</li>
                        <li>Navigate to the "Resume" section</li>
                        <li>Click on "Upload Resume"</li>
                        <li>Select your resume file (supported formats: PDF, DOC, DOCX)</li>
                        <li>Click "Upload" to save your resume</li>
                    </ol>
                    
                    <h5>Portfolio Upload:</h5>
                    <ol>
                        <li>From your profile page, navigate to the "Portfolio" section</li>
                        <li>Click on "Add Portfolio Item"</li>
                        <li>You can either:
                            <ul>
                                <li>Upload files (images, PDFs, etc.)</li>
                                <li>Add links to external portfolio platforms (GitHub, Behance, etc.)</li>
                            </ul>
                        </li>
                        <li>Add a title and description for each portfolio item</li>
                        <li>Click "Save" to add the item to your portfolio</li>
                    </ol>
                    
                    <p>You can upload multiple portfolio items to showcase different aspects of your work. Employers will be able to view your portfolio when reviewing your job applications.</p>
                </div>
                
                <!-- Feedback Buttons -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="$store.faqApp.helpfulVote(6, true)" class="flex items-center text-gray-400 hover:text-[#B9FF66]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span>Helpful</span>
                            <span class="ml-1" id="likes-6">0</span>
                        </button>
                        <button @click="$store.faqApp.helpfulVote(6, false)" class="flex items-center text-gray-400 hover:text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2" />
                            </svg>
                            <span>Not Helpful</span>
                            <span class="ml-1" id="dislikes-6">0</span>
                        </button>
                    </div>
                    <div class="text-xs text-gray-500">Last updated: April 24, 2025</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Job Application Section -->
    <h3 class="text-lg font-semibold text-[#B9FF66] mt-8 mb-3">Job Applications</h3>
    
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden" x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left">
            <h4 class="text-lg font-medium text-white">How do I apply for a job on LokerNow?</h4>
            <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="h-5 w-5 text-gray-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" x-collapse>
            <div class="p-5 border-t border-gray-700 bg-gray-700">
                <div class="prose prose-invert max-w-none">
                    <p>Applying for jobs on LokerNow is simple:</p>
                    <ol>
                        <li>Log in to your LokerNow account</li>
                        <li>Use the search function to find jobs that match your skills and interests</li>
                        <li>Click on a job listing to view the full details</li>
                        <li>Click the "Apply Now" button</li>
                        <li>Select which resume you want to use for this application</li>
                        <li>Write a cover letter or answer any additional questions required by the employer</li>
                        <li>Review your application</li>
                        <li>Click "Submit Application"</li>
                    </ol>
                    <p>After submitting your application, you can track its status in the "My Applications" section of your dashboard.</p>
                </div>
                
                <!-- Feedback Buttons -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="$store.faqApp.helpfulVote(7, true)" class="flex items-center text-gray-400 hover:text-[#B9FF66]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span>Helpful</span>
                            <span class="ml-1" id="likes-7">0</span>
                        </button>
                        <button @click="$store.faqApp.helpfulVote(7, false)" class="flex items-center text-gray-400 hover:text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2" />
                            </svg>
                            <span>Not Helpful</span>
                            <span class="ml-1" id="dislikes-7">0</span>
                        </button>
                    </div>
                    <div class="text-xs text-gray-500">Last updated: April 24, 2025</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden" x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left">
            <h4 class="text-lg font-medium text-white">How do I track my job application status?</h4>
            <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="h-5 w-5 text-gray-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" x-collapse>
            <div class="p-5 border-t border-gray-700 bg-gray-700">
                <div class="prose prose-invert max-w-none">
                    <p>To track the status of your job applications:</p>
                    <ol>
                        <li>Log in to your LokerNow account</li>
                        <li>Click on your account icon and select "My Applications" from the dropdown menu</li>
                        <li>You'll see a list of all your job applications with their current status</li>
                    </ol>
                    
                    <p>Application statuses include:</p>
                    <ul>
                        <li><strong>Pending:</strong> Your application has been submitted but not yet reviewed</li>
                        <li><strong>Reviewing:</strong> The employer is currently reviewing your application</li>
                        <li><strong>Shortlisted:</strong> You've been shortlisted for the next stage of the hiring process</li>
                        <li><strong>Interview Scheduled:</strong> An interview has been scheduled</li>
                        <li><strong>Accepted:</strong> Congratulations! You've been offered the position</li>
                        <li><strong>Rejected:</strong> The employer has decided not to proceed with your application</li>
                    </ul>
                    
                    <p>You'll receive notifications when your application status changes, both in-app and via email (if you've enabled email notifications in your settings).</p>
                </div>
                
                <!-- Feedback Buttons -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="$store.faqApp.helpfulVote(8, true)" class="flex items-center text-gray-400 hover:text-[#B9FF66]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span>Helpful</span>
                            <span class="ml-1" id="likes-8">0</span>
                        </button>
                        <button @click="$store.faqApp.helpfulVote(8, false)" class="flex items-center text-gray-400 hover:text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2" />
                            </svg>
                            <span>Not Helpful</span>
                            <span class="ml-1" id="dislikes-8">0</span>
                        </button>
                    </div>
                    <div class="text-xs text-gray-500">Last updated: April 24, 2025</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Saved Jobs Section -->
    <h3 class="text-lg font-semibold text-[#B9FF66] mt-8 mb-3">Saved Jobs</h3>
    
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden" x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex justify-between items-center p-5 text-left">
            <h4 class="text-lg font-medium text-white">How do I save jobs for later?</h4>
            <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open}" class="h-5 w-5 text-gray-400 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" x-collapse>
            <div class="p-5 border-t border-gray-700 bg-gray-700">
                <div class="prose prose-invert max-w-none">
                    <p>To save jobs for later review:</p>
                    <ol>
                        <li>Browse job listings on LokerNow</li>
                        <li>When you find a job you're interested in but not ready to apply for, click the "Save" button (bookmark icon) on the job card</li>
                        <li>The job will be saved to your "Saved Jobs" list</li>
                    </ol>
                    
                    <p>To access your saved jobs:</p>
                    <ol>
                        <li>Log in to your LokerNow account</li>
                        <li>Click on your account icon and select "Saved Jobs" from the dropdown menu</li>
                        <li>You'll see a list of all the jobs you've saved</li>
                        <li>From here, you can:
                            <ul>
                                <li>View the full job details</li>
                                <li>Apply for the job</li>
                                <li>Remove the job from your saved list</li>
                            </ul>
                        </li>
                    </ol>
                    
                    <p>Saving jobs is a great way to keep track of opportunities you're interested in while you take time to prepare your application materials.</p>
                </div>
                
                <!-- Feedback Buttons -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="$store.faqApp.helpfulVote(9, true)" class="flex items-center text-gray-400 hover:text-[#B9FF66]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                            <span>Helpful</span>
                            <span class="ml-1" id="likes-9">0</span>
                        </button>
                        <button @click="$store.faqApp.helpfulVote(9, false)" class="flex items-center text-gray-400 hover:text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2" />
                            </svg>
                            <span>Not Helpful</span>
                            <span class="ml-1" id="dislikes-9">0</span>
                        </button>
                    </div>
                    <div class="text-xs text-gray-500">Last updated: April 24, 2025</div>
                </div>
            </div>
        </div>
    </div>
</div>
