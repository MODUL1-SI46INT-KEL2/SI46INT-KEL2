<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-xl font-semibold text-gray-900">Job Seeker Registration</h2>
        <p class="mt-2 text-sm text-gray-600">Create an account to find and apply for jobs</p>
    </div>

    <div class="mt-6">
        <!-- Job Seeker Card -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200 hover:border-[#B9FF66] transition-all">
            <a href="{{ route('register.jobseeker') }}" class="block p-6">
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-[#B9FF66] rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-lg font-medium text-center text-gray-900">Job Seeker</h3>
                <p class="mt-2 text-sm text-gray-600 text-center">Create an account to find and apply for jobs</p>
                <div class="mt-4 flex justify-center">
                    <span class="inline-flex items-center px-4 py-2 bg-[#B9FF66] border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-[#a7e55c] focus:bg-[#a7e55c] active:bg-[#a7e55c] focus:outline-none focus:ring-2 focus:ring-[#B9FF66] focus:ring-offset-2 transition ease-in-out duration-150">
                        Continue to Registration
                    </span>
                </div>
            </a>
        </div>
    </div>

    <div class="flex items-center justify-center mt-6">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
            {{ __('Already have an account?') }}
        </a>
    </div>
</x-guest-layout>
