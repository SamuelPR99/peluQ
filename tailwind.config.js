import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flyonui/dist/js/*.js',
    ],

    theme: {
        extend: {
            boxShadow:{
                '3xl':'0 35px 60px -15px rgba(0, 0, 0, 0.3)',
            },
            dropShadow:{
                '3xl':'0 4px 20px rgba(0, 0, 0, 10)',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            
        },
    },

    plugins: [
        forms,
        require("flyonui"),
        require("flyonui/plugin") // Require only if you want to use FlyonUI JS component
    ],
};
