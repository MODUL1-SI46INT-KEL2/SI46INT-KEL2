@extends('layouts.app')

@section('content')
    <style>
        input[type="checkbox"].circle:checked+span::before {
            background-color: #1d4ed8;

        }

        input[type="checkbox"].circle+span::before {
            content: "";
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border-radius: 9999px;
            border: 2px solid #555;
            margin-right: 0.5rem;
            vertical-align: middle;
            transition: all 0.2s ease;
        }
    </style>

    <div class="px-6 py-10 max-w-7xl mx-auto" x-data="{ showFilters: false }">
        <h1 class="text-4xl font-bold mb-8">Job Search</h1>
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
            <div class="flex items-center border border-gray-400 rounded-full px-4 py-2 w-full sm:w-auto">
                <img src="{{ asset('search.svg') }}" alt="Search" class="w-5 h-5 mr-2">
                <input type="text" placeholder="Title, skill or company"
                    class="outline-none bg-transparent w-full sm:w-[250px] placeholder-gray-500 text-sm">
            </div>
            <button @click="showFilters = !showFilters"
                class="flex items-center gap-2 rounded-full px-4 py-2 text-sm font-medium hover:bg-gray-100 transition">
                <span x-text="showFilters ? 'Close' : 'Filters'"></span>
                <span class="w-7 h-7 flex items-center justify-center border border-gray-700 rounded-full text-xl font-bold"
                    x-text="showFilters ? '-' : '+'"></span>
            </button>

        </div>
        <div x-show="showFilters" x-transition class="border border-gray-300 rounded-2xl p-6 mb-8 bg-[#F3F3F3] shadow-md">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Experience Level --}}
                <div>
                    <h2 class="font-semibold mb-2">Experience Level</h2>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        @foreach (['Internship', 'Entry Level', 'Associate', 'Mid-Senior Level', 'Director', 'Executive'] as $level)
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="hidden circle">
                                <span>{{ $level }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Job Function --}}
                <div>
                    <h2 class="font-semibold mb-2">Job Function</h2>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        @foreach (['Sales', 'Management', 'Finance', 'Administrative', 'Training', 'Marketing'] as $job)
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="hidden circle">
                                <span>{{ $job }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Employment Type --}}
                <div>
                    <h2 class="font-semibold mb-2">Employment Type</h2>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        @foreach (['Full-Time', 'Part-Time', 'Contract', 'Temporary', 'Internship'] as $type)
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="hidden circle">
                                <span>{{ $type }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Benefits --}}
                <div>
                    <h2 class="font-semibold mb-2">Benefits</h2>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        @foreach (['Pension Plan', 'Dental Insurance', 'Vision Insurance', 'Disability Insurance', 'Commuter Benefits'] as $benefit)
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="hidden circle">
                                <span>{{ $benefit }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Industry --}}
                <div>
                    <h2 class="font-semibold mb-2">Industry</h2>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        @foreach (['Financial Services', 'Software Development', 'IT Services and Consulting', 'Banking', 'Manufacturing', 'Hospitality'] as $industry)
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="hidden circle">
                                <span>{{ $industry }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Title --}}
                <div>
                    <h2 class="font-semibold mb-2">Title</h2>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        @foreach (['Marketing Associate', 'Software Engineer', 'Marketing Specialist', 'Data Analyst', 'Business Student'] as $title)
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="hidden circle">
                                <span>{{ $title }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            {{-- Card 1 - Selected --}}
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

            {{-- Card 1 - Selected --}}
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


        </div>
    </div>
@endsection
