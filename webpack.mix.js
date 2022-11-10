const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css').options({
        // processCssUrls: false
    })
    .js('resources/js/plugins.js', 'public/js')
    .sass('resources/sass/plugins.scss', 'public/css')
    .js('resources/js/toastr.js', 'public/js')
    .sass('resources/sass/toastr.scss', 'public/css')
    .js('resources/js/sweetalert2.js', 'public/js')
    .sass('resources/sass/sweetalert2.scss', 'public/css')
    .sass('resources/sass/tailwind.scss', 'public/css').options({
        postCss: [ tailwindcss('./tailwind.config.js') ],
        // processCssUrls: false
    })
    .sourceMaps();
