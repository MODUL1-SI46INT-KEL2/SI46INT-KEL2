@props(['id' => 'theme-toggle', 'class' => ''])

<button 
    id="{{ $id }}" 
    type="button"
    {{ $attributes->merge(['class' => 'inline-flex items-center p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66] ' . $class]) }}
    x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
    x-init="
        if (localStorage.getItem('darkMode') === null) {
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                localStorage.setItem('darkMode', 'true');
                darkMode = true;
                document.documentElement.classList.add('dark');
            } else {
                localStorage.setItem('darkMode', 'false');
                darkMode = false;
                document.documentElement.classList.remove('dark');
            }
        } else if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    "
    @click="
        darkMode = !darkMode;
        localStorage.setItem('darkMode', darkMode);
        if (darkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    "
>
    <span x-show="!darkMode" class="sr-only">Dark mode</span>
    <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
    </svg>
    
    <span x-show="darkMode" class="sr-only">Light mode</span>
    <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
    </svg>
</button>
