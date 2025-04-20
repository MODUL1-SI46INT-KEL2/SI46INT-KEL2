<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Company Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('company_profile.update', $companyProfile->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                            <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $companyProfile->company_name) }}" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="company_description" class="block text-sm font-medium text-gray-700">Company Description</label>
                            <textarea name="company_description" id="company_description" class="mt-1 block w-full">{{ old('company_description', $companyProfile->company_description) }}</textarea>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
