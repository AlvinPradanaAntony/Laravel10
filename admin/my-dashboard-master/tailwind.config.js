/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    darkMode: 'class',

    theme: {
        extend: {
            colors: {
            'gray-850':'#141e2c',
            'gray-750':'#1a2432',
            },
        },
    },

    plugins: [],
}
