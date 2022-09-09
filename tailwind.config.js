/** @type {import('tailwindcss').Config} */
module.exports = {
    prefix: "tw-",
    content: [
        "./resources/**/*.{blade.php,js,vue}",
        "./app/Http/Controllers/**/*.php",
    ],
    theme: {
        extend: {},
    },
    plugins: [],
    corePlugins: {
      preflight: false
    }
};
