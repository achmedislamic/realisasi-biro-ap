const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./vendor/wireui/wireui/resources/**/*.blade.php",
        "./vendor/wireui/wireui/ts/**/*.ts",
        "./vendor/wireui/wireui/src/View/**/*.php",
    ],

    presets: [require("./vendor/wireui/wireui/tailwind.config.js")],

    theme: {
        extend: {
            backgroundImage: {
              'hero': "url('/img/walpaper-hero.webp')"
            },
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                gemilang: {
                    "light-orange": "#FEAA1B",
                    "medium-orange": "#FBA51C",
                    "heavy-orange": "#EB6B22",
                },
                utama: "#6366F1",
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
