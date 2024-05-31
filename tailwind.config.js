import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                hero2: ['Figtree', ...defaultTheme.fontFamily.sans],
                sans: ['Kumbh', ...defaultTheme.fontFamily.sans],
                hero: ['Kumbh', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                spotify: '#1DB954',
            },
        },

    },

    plugins: [require('daisyui')],

};
