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
                'madang': {
                    '50': '#eefff0',
                    '100': '#d8ffe0',
                    '200': '#bdffca',
                    '300': '#78fd94',
                    '400': '#36f25e',
                    '500': '#0cdb38',
                    '600': '#03b62a',
                    '700': '#078e24',
                    '800': '#0b7022',
                    '900': '#0c5b1f',
                    '950': '#00330d',
                },
                'jordy-blue': {
                    '50': '#eff5ff',
                    '100': '#dae7ff',
                    '200': '#bed5ff',
                    '300': '#9ec3ff',
                    '400': '#5d97fd',
                    '500': '#376ffa',
                    '600': '#214fef',
                    '700': '#193adc',
                    '800': '#1b31b2',
                    '900': '#1c2f8c',
                    '950': '#161e55',
                }
            },
            animation: {
                'float': 'float 6s ease-in-out infinite',
                'pulse-slow': 'pulse 3s ease-in-out infinite',
                'spin-slow': 'spin 8s linear infinite',
                'blob': 'blob 7s infinite',
                'scroll': 'scroll 40s linear infinite',
                'shimmer': 'shimmer 1.5s infinite',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-10px)' },
                },
                blob: {
                    '0%': { transform: 'scale(1)' },
                    '33%': { transform: 'scale(1.1)' },
                    '66%': { transform: 'scale(0.9)' },
                    '100%': { transform: 'scale(1)' },
                },
                scroll: {
                    '0%': { transform: 'translateX(0)' },
                    '100%': { transform: 'translateX(calc(-100% / 2))' },
                },
                shimmer: {
                    '0%': { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' },
                },
            },
            transitionProperty: {
                'width': 'width',
                'height': 'height',
            },
        },
    },

    plugins: [forms],
};