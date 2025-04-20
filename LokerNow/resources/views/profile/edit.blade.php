<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Profile Update Section -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Profile Information Form -->
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Ensure it uses the PUT method -->

                        <!-- Include your form inputs here, like name, email, etc. -->
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required />
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required />
                        
                        <button type="submit" class="mt-4">Update Profile</button>
                    </form>
                </div>
            </div>

            <!-- Change Password Section -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Password Update Form -->
                    <form action="{{ route('profile.password.update') }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Ensure it uses the PUT method for password update -->

                        <!-- Include your form inputs for changing password -->
                        <input type="password" name="current_password" placeholder="Current Password" required />
                        <input type="password" name="new_password" placeholder="New Password" required />
                        
                        <button type="submit" class="mt-4">Change Password</button>
                    </form>
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Account Deletion Form -->
                    <form action="{{ route('profile.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE') <!-- DELETE method for deleting account -->

                        <button type="submit" class="mt-4 text-red-500">Delete Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
