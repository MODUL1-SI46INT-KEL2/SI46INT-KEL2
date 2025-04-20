{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Space Grotesk', sans-serif;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @vite('resources/css/app.css')
</head>

<body class="bg-white text-black font-sans antialiased">

    {{-- Navbar --}}
    <nav class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
        <div class="flex items-center gap-2">
            <img src="{{ asset('icon.svg') }}" alt="{{ config('app.name') }}" class="w-6 h-6" />
            <span class="text-xl font-semibold">{{ config('app.name') }}</span>
        </div>

        <ul class="hidden md:flex items-center gap-6 text-sm font-small">
            <li>
                <a href="/"
                    class="hover:text-gray-600 {{ request()->is('/') ? 'font-bold text-black' : '' }}">Home</a>
            </li>
            <li>
                <a href="/search-jobs"
                    class="hover:text-gray-600 {{ request()->is('search-jobs') ? 'font-bold text-black' : '' }}">Find
                    Jobs</a>
            </li>
            <li>
                <a href="#"
                    class="hover:text-gray-600 {{ request()->is('companies') ? 'font-bold text-black' : '' }}">Companies</a>
            </li>
            <li>
                <a href="#"
                    class="hover:text-gray-600 {{ request()->is('messages') ? 'font-bold text-black' : '' }}">Messages</a>
            </li>
            <li><a href="#"><img src="{{ asset('megaphone.svg') }}" alt="" class="w-6 h-6"></a></li>
            <li><a href="#"><img src="{{ asset('account.svg') }}" alt="" class="w-6 h-6"></a></li>
        </ul>

    </nav>

    {{-- Main content --}}
    <main>
        @yield('content')
    </main>

</body>

</html>
