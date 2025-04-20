{{-- resources/views/saved-jobs.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="px-6 py-10 max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold mb-8">Saved Jobs</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

            <div class="text-black rounded-2xl p-8 relative shadow-lg min-h-[220px] outline outline-1 outline-gray-900"
                style="background-color: #B9FF66;">
                <div x-data="{ loved: true, darkIcon: false }" class="absolute top-4 right-4">
                    <button @click="loved = !loved">
                        <img :src="loved
                            ?
                            (darkIcon ? '/love-white.svg' : '/love.svg') :
                            (darkIcon ? '/unlove-white.svg' : '/unlove.svg')"
                            alt="Love Icon" class="w-6 h-6">
                    </button>
                </div>
                <h2 class="inline-block bg-white text-black text-xl lg:text-2xl font-semibold mb-3 px-3 py-1 rounded">
                    Supply Chain Intern
                </h2>
                <p class="text-sm font-medium mb-6">Unilever Indonesia</p>
                <a href="#" class="flex items-center text-sm font-medium gap-2">
                    <img src="{{ asset('learn-more-dark.svg') }}" alt="" class="w-6 h-6">Learn more
                </a>
            </div>

            {{-- Card 2 --}}
            <div class="bg-gray-100 rounded-2xl p-8 relative shadow-sm min-h-[220px] outline outline-1 outline-gray-900">
                <div x-data="{ loved: true, darkIcon: false }" class="absolute top-4 right-4">
                    <button @click="loved = !loved">
                        <img :src="loved
                            ?
                            (darkIcon ? '/love-white.svg' : '/love.svg') :
                            (darkIcon ? '/unlove-white.svg' : '/unlove.svg')"
                            alt="Love Icon" class="w-6 h-6">
                    </button>
                </div>
                <h2 class="inline-block bg-white text-black text-xl lg:text-2xl font-semibold mb-3 px-3 py-1 rounded">
                    Business Analyst Intern
                </h2>
                <p class="text-sm font-medium mb-6">Philip Morris International</p>
                <a href="#" class="flex items-center text-sm font-medium text-black gap-2">
                    <img src="{{ asset('learn-more-dark.svg') }}" alt="" class="w-6 h-6">Learn more
                </a>
            </div>

            {{-- Card 3 --}}
            <div
                class="bg-gray-900 text-white rounded-2xl p-8 relative shadow-sm min-h-[220px] outline outline-1 outline-gray-900">
                <div x-data="{ loved: true, darkIcon: true }" class="absolute top-4 right-4">
                    <button @click="loved = !loved">
                        <img :src="loved
                            ?
                            (darkIcon ? '/love-white.svg' : '/love.svg') :
                            (darkIcon ? '/unlove-white.svg' : '/unlove.svg')"
                            alt="Love Icon" class="w-6 h-6">
                    </button>
                </div>
                <h2 class="inline-block bg-white text-black text-xl lg:text-2xl font-semibold mb-3 px-3 py-1 rounded">
                    Frontend Developer
                </h2>
                <p class="text-sm font-medium mb-6">DANA Indonesia</p>
                <a href="#" class="flex items-center text-sm font-medium gap-2">
                    <img src="{{ asset('learn-more-white.svg') }}" alt="" class="w-6 h-6">Learn more
                </a>
            </div>


            {{-- Card 4 --}}
            <div
                class="bg-gray-900 text-white rounded-2xl p-8 relative shadow-sm min-h-[220px] outline outline-1 outline-gray-900">
                <div x-data="{ loved: true, darkIcon: true }" class="absolute top-4 right-4">
                    <button @click="loved = !loved">
                        <img :src="loved
                            ?
                            (darkIcon ? '/love-white.svg' : '/love.svg') :
                            (darkIcon ? '/unlove-white.svg' : '/unlove.svg')"
                            alt="Love Icon" class="w-6 h-6">
                    </button>
                </div>
                <h2 class="inline-block bg-white text-black text-xl lg:text-2xl font-semibold mb-3 px-3 py-1 rounded">
                    Data Analyst Intern
                </h2>
                <p class="text-sm font-medium mb-6">Accenture Indonesia</p>
                <a href="#" class="flex items-center text-sm font-medium gap-2">
                    <img src="{{ asset('learn-more-white.svg') }}" alt="" class="w-6 h-6">Learn more
                </a>
            </div>

        </div>
    </div>
@endsection
