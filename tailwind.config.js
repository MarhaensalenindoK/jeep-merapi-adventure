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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'admin': {
                    'primary': '#201E43',    // Dark navy blue
                    'secondary': '#134B70',  // Medium blue
                    'accent': '#508C9B',     // Light blue/teal
                    'light': '#EEEEEE',     // Light gray
                },
            },
        },
    },

    plugins: [forms],
};
