import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                body: '#1E1E1E',
                gray: {
                    text: '#F6EAEA',
                    light: '#3C3C3C',
                    primary: '#272727',
                    secondary: '#A4A4A4',
                },
                gold: {
                    primary: '#D69A5F',
                    secondary: '#775D43'
                }
            }
        },

    },

    plugins: [forms],
};
