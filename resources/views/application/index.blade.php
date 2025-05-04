@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-900 to-gray-800 py-12 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white">My Applications</h1>
                <p class="text-gray-400 mt-1">Track and manage your job applications</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('search.jobs') }}" class="inline-flex items-center px-5 py-3 rounded-lg bg-[#B9FF66] text-black font-medium hover:bg-[#a8e65c] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Find More Jobs
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-gray-800 rounded-xl p-6 mb-8 border border-gray-700" x-data="{ activeTab: 'all' }">
            <div class="flex flex-wrap gap-4 mb-6">
                <button @click="activeTab = 'all'" :class="activeTab === 'all' ? 'bg-[#B9FF66] text-black' : 'bg-gray-700 text-white hover:bg-gray-600'" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    All Applications
                </button>
                <button @click="activeTab = 'pending'" :class="activeTab === 'pending' ? 'bg-[#B9FF66] text-black' : 'bg-gray-700 text-white hover:bg-gray-600'" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Pending
                </button>
                <button @click="activeTab = 'reviewing'" :class="activeTab === 'reviewing' ? 'bg-[#B9FF66] text-black' : 'bg-gray-700 text-white hover:bg-gray-600'" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Reviewing
                </button>
                <button @click="activeTab = 'shortlisted'" :class="activeTab === 'shortlisted' ? 'bg-[#B9FF66] text-black' : 'bg-gray-700 text-white hover:bg-gray-600'" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Shortlisted
                </button>
                <button @click="activeTab = 'accepted'" :class="activeTab === 'accepted' ? 'bg-[#B9FF66] text-black' : 'bg-gray-700 text-white hover:bg-gray-600'" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Accepted
                </button>
                <button @click="activeTab = 'rejected'" :class="activeTab === 'rejected' ? 'bg-[#B9FF66] text-black' : 'bg-gray-700 text-white hover:bg-gray-600'" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Rejected
                </button>
            </div>

            <div class="relative">
                <input type="text" placeholder="Search applications by job title, company..." class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:border-transparent">
                <button class="absolute right-3 top-3 text-gray-400 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Applications List -->
        <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left py-4 px-6 text-gray-400 font-medium text-sm">Job</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-medium text-sm">Company</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-medium text-sm">Status</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-medium text-sm">Applied</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-medium text-sm">Last Update</th>
                        <th class="text-left py-4 px-6 text-gray-400 font-medium text-sm"></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Placeholder for application data -->
                    <tr class="border-b border-gray-700 hover:bg-gray-700">
                        <td class="py-4 px-6">
                            <p class="text-white font-medium">Software Engineer</p>
                        </td>
                        <td class="py-4 px-6 text-gray-300">
                            TechCorp
                        </td>
                        <td class="py-4 px-6">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                Pending
                            </span>
                        </td>
                        <td class="py-4 px-6 text-gray-400 text-sm">
                            2 days ago
                        </td>
                        <td class="py-4 px-6 text-gray-400 text-sm">
                            2 days ago
                        </td>
                        <td class="py-4 px-6 text-right">
                            <a href="{{ route('applications.show', 1) }}" class="text-[#B9FF66] text-sm font-medium hover:underline">View Details</a>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-700 hover:bg-gray-700">
                        <td class="py-4 px-6">
                            <p class="text-white font-medium">UX Designer</p>
                        </td>
                        <td class="py-4 px-6 text-gray-300">
                            DesignHub
                        </td>
                        <td class="py-4 px-6">
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                Reviewing
                            </span>
                        </td>
                        <td class="py-4 px-6 text-gray-400 text-sm">
                            1 week ago
                        </td>
                        <td class="py-4 px-6 text-gray-400 text-sm">
                            2 days ago
                        </td>
                        <td class="py-4 px-6 text-right">
                            <a href="{{ route('applications.show', 2) }}" class="text-[#B9FF66] text-sm font-medium hover:underline">View Details</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-700">
                        <td class="py-4 px-6">
                            <p class="text-white font-medium">Product Manager</p>
                        </td>
                        <td class="py-4 px-6 text-gray-300">
                            InnovateCo
                        </td>
                        <td class="py-4 px-6">
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                Shortlisted
                            </span>
                        </td>
                        <td class="py-4 px-6 text-gray-400 text-sm">
                            2 weeks ago
                        </td>
                        <td class="py-4 px-6 text-gray-400 text-sm">
                            3 days ago
                        </td>
                        <td class="py-4 px-6 text-right">
                            <a href="{{ route('applications.show', 3) }}" class="text-[#B9FF66] text-sm font-medium hover:underline">View Details</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-8">
            <nav class="inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-700 bg-gray-800 text-sm font-medium text-gray-400 hover:bg-gray-700">
                    <span class="sr-only">Previous</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="#" aria-current="page" class="z-10 bg-[#B9FF66] border-[#B9FF66] text-black relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                    1
                </a>
                <a href="#" class="bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                    2
                </a>
                <a href="#" class="bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                    3
                </a>
                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-700 bg-gray-800 text-sm font-medium text-gray-400 hover:bg-gray-700">
                    <span class="sr-only">Next</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </nav>
        </div>
    </div>
</div>
@endsection
