/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    theme: {
        colors: {
            "class-primary": "#ffffff",
            "class-secondary": "#229799",
            "class-tertiary": "#424242",
            "class-quaternary": "#48CFCB",
        },
        extend: {},
    },
    plugins: [],
};
