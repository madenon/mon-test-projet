import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "primary-color": "#24A19C",
                "primary-hover": "#6EBFB5",
                "secondary-color": "#FF5F40",
                "secondary-hover": "#FF6F53",
                third: "#FFC7C7",
                titles: "#373737",
                text: "#717171",
                line: "#D2D2D2",
            },
            backgroundImage: {
                custom: 'url("images/signup-bg-pattern.svg")', // Remplacez le chemin par le chemin de votre image
            },
            gap: {
                '11': '3rem',
            },
            screens: {
                'sm': '640px',
                'md': '768px',
                'lg': '1024px',
                'xl': '1280px',
            },
            
        },
    },

    plugins: [forms],
};
