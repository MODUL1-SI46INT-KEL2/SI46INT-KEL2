{{-- resources/views/admin/jobs/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-[#B9FF66] rounded-2xl p-8 w-full max-w-md shadow-md">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold mb-2">Post a job for free</h1>
            <p class="text-gray-700">Increase the quality of your hire</p>
        </div>

        <form action="{{ route('admin.jobs.details') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <input 
                    type="text" 
                    name="job_title" 
                    id="job_title" 
                    placeholder="Job Title" 
                    class="w-full px-4 py-2 rounded-full border-0 focus:ring-2 focus:ring-black"
                    required
                >
            </div>

            <div class="flex justify-center">
                <button 
                    type="submit" 
                    class="bg-black text-white px-6 py-2 rounded-full hover:bg-gray-800 transition duration-200"
                >
                    Next
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
