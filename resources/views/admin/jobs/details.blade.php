{{-- resources/views/admin/jobs/details.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-[#B9FF66] rounded-2xl p-6 w-full max-w-3xl shadow-md">
        <div class="mb-4">
            <h2 class="text-lg font-bold">Job details</h2>
            <p class="text-sm">{{ $jobTitle }}</p>
        </div>

        <form action="{{ route('admin.jobs.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="job_title" value="{{ $jobTitle }}">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="company" class="block text-sm font-medium mb-1">Company</label>
                    <input 
                        type="text" 
                        name="company" 
                        id="company" 
                        class="w-full px-3 py-2 border-0 rounded-md focus:ring-2 focus:ring-black"
                        required
                    >
                </div>
                
                <div>
                    <label for="job_location" class="block text-sm font-medium mb-1">Job Location</label>
                    <input 
                        type="text" 
                        name="job_location" 
                        id="job_location" 
                        class="w-full px-3 py-2 border-0 rounded-md focus:ring-2 focus:ring-black"
                        required
                    >
                </div>
                
                <div>
                    <label for="position_type" class="block text-sm font-medium mb-1">Position Type</label>
                    <select 
                        name="position_type" 
                        id="position_type" 
                        class="w-full px-3 py-2 border-0 rounded-md focus:ring-2 focus:ring-black"
                        required
                    >
                        <option value="">Select Position Type</option>
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Contract">Contract</option>
                        <option value="Freelance">Freelance</option>
                        <option value="Internship">Internship</option>
                    </select>
                </div>
                
                <div>
                    <label for="job_type" class="block text-sm font-medium mb-1">Job Type</label>
                    <select 
                        name="job_type" 
                        id="job_type" 
                        class="w-full px-3 py-2 border-0 rounded-md focus:ring-2 focus:ring-black"
                        required
                    >
                        <option value="">Select Job Type</option>
                        <option value="Remote">Remote</option>
                        <option value="On-site">On-site</option>
                        <option value="Hybrid">Hybrid</option>
                    </select>
                </div>
                
                <div>
                    <label for="salary" class="block text-sm font-medium mb-1">Salary</label>
                    <input 
                        type="number" 
                        name="salary" 
                        id="salary" 
                        class="w-full px-3 py-2 border-0 rounded-md focus:ring-2 focus:ring-black"
                        required
                        step="0.01"
                    >
                </div>
                
                <div>
                    <label for="category" class="block text-sm font-medium mb-1">Category</label>
                    <select 
                        name="category" 
                        id="category" 
                        class="w-full px-3 py-2 border-0 rounded-md focus:ring-2 focus:ring-black"
                    >
                        <option value="General">General</option>
                        <option value="Technology">Technology</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Finance">Finance</option>
                        <option value="Healthcare">Healthcare</option>
                        <option value="Education">Education</option>
                        <option value="Sales">Sales</option>
                        <option value="Design">Design</option>
                    </select>
                </div>
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium mb-1">Description</label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="5" 
                    class="w-full px-3 py-2 border-0 rounded-md focus:ring-2 focus:ring-black"
                    required
                ></textarea>
            </div>
            
            <div class="flex justify-center">
                <button 
                    type="submit" 
                    class="bg-black text-white px-6 py-2 rounded-full hover:bg-gray-800 transition duration-200"
                >
                    Post
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
