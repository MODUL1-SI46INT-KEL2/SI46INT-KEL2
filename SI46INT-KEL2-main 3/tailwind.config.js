import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Space Grotesk', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'lime-green': '#B9FF66',
                'brand': {
                    DEFAULT: '#B9FF66',
                    'light': '#d4ff9e',
                    'dark': '#a7e55c',
                },
                'dark': {
                    'bg': '#111827',
                    'card': '#1F2937',
                    'input': '#374151',
                },
                'light': {
                    'bg': '#F9FAFB',
                    'card': '#FFFFFF',
                    'input': '#F3F4F6',
                },
            },
        },
    },

    plugins: [forms],
};
