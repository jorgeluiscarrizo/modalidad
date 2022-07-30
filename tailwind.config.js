const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    '50': '#7CD5F0',
                    '100': '#6ACFED',
                    '200': '#45C3E9',
                    '300': '#21B7E5',
                    '400': '#179DC5',
                    '500': '#1380A1',
                    '600': '#0D586F',
                    '700': '#07303D',
                    '800': '#01080A',
                    '900': '#000000'
                },
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
