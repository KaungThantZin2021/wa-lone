/** @type {import('tailwindcss').Config} */
module.exports = {
    prefix: "tw-",
    darkMode: 'class',
    // important: true,
    content: [
        "./resources/**/*.{blade.php,js,vue}",
        "./app/Http/Controllers/**/*.php",
    ],
    theme: {
        extend: {},
        screens: {
            '2xl': {'max': '1535px'},
            // => @media (max-width: 1535px) { ... }

            'xl': {'max': '1279px'},
            // => @media (max-width: 1279px) { ... }

            'lg': {'max': '1023px'},
            // => @media (max-width: 1023px) { ... }

            'md': {'max': '767px'},
            // => @media (max-width: 767px) { ... }

            'sm': {'max': '639px'},
            // => @media (max-width: 639px) { ... }

            'xs': {'max' : '475px'},
            // => @media (max-width: 475px) { ... }

            '2xs': {'max' : '350px'},
            // => @media (max-width: 475px) { ... }
        }
    },
    plugins: [],
    corePlugins: {
      preflight: false
    }
};
