{{-- resources/views/employer/profile/edit.blade.php --}}
@extends('layouts.app')

@section('content')
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Logo preview functionality
        const logoInput = document.getElementById('logo');
        const logoPreview = document.getElementById('logo-preview');
        
        logoInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    logoPreview.src = e.target.result;
                    logoPreview.style.display = 'block';
                    document.getElementById('no-logo-text').style.display = 'none';
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        // Banner preview functionality
        const bannerInput = document.getElementById('banner');
        const bannerPreview = document.getElementById('banner-preview');
        
        bannerInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    bannerPreview.src = e.target.result;
                    bannerPreview.style.display = 'block';
                    document.getElementById('no-banner-text').style.display = 'none';
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endpush
<div class="px-6 py-8 bg-gray-900 text-white min-h-screen">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-white">Company Profile</h1>
        <a href="{{ route('employer.dashboard') }}" class="text-gray-300 hover:text-white transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Dashboard
        </a>
    </div>
    
    @if(session('success'))
    <div class="bg-green-900 border-l-4 border-green-500 text-green-300 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif
    
    @if(session('error'))
    <div class="bg-red-900 border-l-4 border-red-500 text-red-300 p-4 mb-6" role="alert">
        <p>{{ session('error') }}</p>
    </div>
    @endif
    
    <div class="bg-gray-800 rounded-xl shadow-md border border-gray-700 overflow-hidden">

        <form action="{{ route('employer.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Company Banner Preview -->
            <div class="w-full">
                <div class="relative bg-gray-700 w-full h-64 overflow-hidden">
                    @if($companyProfile->banner_path)
                        <img id="banner-preview" src="{{ asset('storage/' . $companyProfile->banner_path) }}" alt="Company Banner" class="w-full h-64 object-cover">
                        <div id="no-banner-text" class="hidden w-full h-64 flex items-center justify-center text-gray-400">
                            <span>No banner uploaded</span>
                        </div>
                    @else
                        <img id="banner-preview" src="#" alt="Company Banner" class="w-full h-64 object-cover hidden">
                        <div id="no-banner-text" class="w-full h-64 flex items-center justify-center text-gray-400">
                            <span>No banner uploaded</span>
                        </div>
                    @endif
                    
                    <div class="absolute bottom-4 right-4">
                        <label for="banner" class="bg-gray-900 text-gray-200 rounded-lg px-4 py-2 shadow-sm border border-gray-600 cursor-pointer hover:bg-gray-800 transition duration-200">
                            <span class="text-sm font-medium">Change Banner</span>
                            <input type="file" id="banner" name="banner" class="hidden">
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <!-- Company Logo -->
                <div class="flex items-start mb-6">
                    <div class="mr-4">
                        <div class="relative h-24 w-24 rounded-lg bg-gray-700 overflow-hidden">
                            @if($companyProfile->logo_path)
                                <img id="logo-preview" src="{{ asset('storage/' . $companyProfile->logo_path) }}" alt="Company Logo" class="w-24 h-24 object-cover">
                                <div id="no-logo-text" class="hidden w-24 h-24 flex items-center justify-center text-gray-400">
                                    <span>No logo</span>
                                </div>
                            @else
                                <img id="logo-preview" src="#" alt="Company Logo" class="w-24 h-24 object-cover hidden">
                                <div id="no-logo-text" class="w-24 h-24 flex items-center justify-center text-gray-400">
                                    <span>No logo</span>
                                </div>
                            @endif
                        </div>
                        <label for="logo" class="block text-center mt-2 text-sm text-[#B9FF66] cursor-pointer hover:underline">
                            Change Logo
                            <input type="file" id="logo" name="logo" class="hidden">
                        </label>
                    </div>
                    
                    <div class="flex-1">
                        <!-- Company Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Company Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $companyProfile->name) }}" 
                                class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                            @error('name')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Company Website -->
                        <div class="mb-4">
                            <label for="website" class="block text-sm font-medium text-gray-300 mb-1">Website</label>
                            <input type="url" id="website" name="website" value="{{ old('website', $companyProfile->website) }}" 
                                class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                            @error('website')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Company Tagline -->
                <div class="mb-4">
                    <label for="tagline" class="block text-sm font-medium text-gray-300 mb-1">Tagline</label>
                    <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $companyProfile->tagline) }}" 
                        class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66]">
                    <p class="text-gray-400 text-xs mt-1">A short slogan that describes your company</p>
                    @error('tagline')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="bg-[#B9FF66] hover:bg-[#a7e55c] px-6 py-2 rounded-lg text-black text-sm font-medium shadow-sm transition duration-200">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
