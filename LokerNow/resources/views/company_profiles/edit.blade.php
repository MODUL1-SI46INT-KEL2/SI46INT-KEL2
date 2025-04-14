<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Edit Company Profile') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 text-green-600 dark:text-green-400">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('company-profiles.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Logo -->
                    <div class="mb-4">
                        <x-input-label for="logo" value="Company Logo" />
                        <input type="file" name="logo" id="logo" class="block mt-1 w-full" />
                        @if ($companyProfile && $companyProfile->logo_path)
                            <img src="{{ asset('storage/' . $companyProfile->logo_path) }}" alt="Logo" class="h-24 mt-2">
                        @endif
                        <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                    </div>

                    <!-- Banner -->
                    <div class="mb-4">
                        <x-input-label for="banner" value="Company Banner" />
                        <input type="file" name="banner" id="banner" class="block mt-1 w-full" />
                        @if ($companyProfile && $companyProfile->banner_path)
                            <img src="{{ asset('storage/' . $companyProfile->banner_path) }}" alt="Banner" class="h-32 mt-2">
                        @endif
                        <x-input-error :messages="$errors->get('banner')" class="mt-2" />
                    </div>

                    <!-- Tagline -->
                    <div class="mb-4">
                        <x-input-label for="tagline" value="Company Tagline" />
                        <x-text-input id="tagline" class="block mt-1 w-full"
                            type="text"
                            name="tagline"
                            value="{{ old('tagline', $companyProfile->tagline ?? '') }}"
                            placeholder="Enter company tagline"
                        />
                        <x-input-error :messages="$errors->get('tagline')" class="mt-2" />
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>
                            {{ __('Save Company Profile') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
