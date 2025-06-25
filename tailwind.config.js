import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',

        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",

        "./src/**/*.{html,js}",
        "./node_modules/tw-elements/js/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Nunito Sans"', 'sans-serif'],
                texto: ['"Nunito Sans"', 'sans-serif'],
            },
        },
    },

    plugins: [forms, require("tw-elements/plugin.cjs")],
    darkMode: "class"
};
