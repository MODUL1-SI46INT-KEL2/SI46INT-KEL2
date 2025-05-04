<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LokerNow') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #111827;
            color: #ffffff;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-900 text-white">    
    <div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 flex justify-center">
            <svg class="w-12 h-12 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="#B9FF66" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2 17L12 22L22 17" stroke="#B9FF66" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2 12L12 17L22 12" stroke="#B9FF66" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        
        <div class="text-center mb-2">
            <h1 class="text-2xl font-bold text-white">Loker<span class="text-[#B9FF66]">Now</span></h1>
        </div>
        
        <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-8">
                <h2 class="text-xl font-bold text-center text-white mb-1">Welcome Back</h2>
                <p class="text-sm text-center text-gray-400 mb-6">Sign in to access your LokerNow account</p>
                
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    
                    <!-- Email Address -->
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <div class="relative">
                            <input id="email" name="email" type="email" :value="old('email')" required autofocus autocomplete="username" 
                                class="w-full bg-gray-700 border border-gray-600 rounded-md py-3 px-4 text-white placeholder-gray-400 focus:ring-[#B9FF66] focus:border-[#B9FF66]" 
                                placeholder="your.email@example.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                    </div>
                    
                    <!-- Password -->
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" required autocomplete="current-password" 
                                class="w-full bg-gray-700 border border-gray-600 rounded-md py-3 px-4 text-white placeholder-gray-400 focus:ring-[#B9FF66] focus:border-[#B9FF66]" 
                                placeholder="Enter your password">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                    </div>
                    
                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" 
                            class="h-4 w-4 rounded border-gray-600 bg-gray-700 text-[#B9FF66] focus:ring-[#B9FF66] focus:ring-offset-gray-800">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-300">Remember me</label>
                        
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="ml-auto text-sm text-[#B9FF66] hover:text-[#a7e55c]">
                                Forgot password?
                            </a>
                        @endif
                    </div>
                    
                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-black bg-[#B9FF66] hover:bg-[#a7e55c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66] focus:ring-offset-gray-800">
                            Sign In
                        </button>
                    </div>
                </form>
                
                <div class="mt-6 text-center">
                    @if (Route::has('register'))
                        <p class="text-sm text-gray-400">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="text-[#B9FF66] hover:text-[#a7e55c]">
                                Create an account
                            </a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
