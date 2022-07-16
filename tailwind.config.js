const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                "scale-up-center": "scale-up-center 0.4s cubic-bezier(0.390, 0.575, 0.565, 1.000)   both",
                'spin-slow': 'spin 3s linear infinite',
                "bounce-top": "bounce-top 0.9s ease-out   backwards"
            },
            keyframes: {
                "scale-up-center": {
                    "0%": {
                        transform: "scale(.5)"
                    },
                    to: {
                        transform: "scale(1)"
                    }
                },
                "bounce-top": {
                    "0%": {
                        transform: "translateY(-45px)",
                        "animation-timing-function": "ease-in",
                        opacity: "1"
                    },
                    "24%": {
                        opacity: "1"
                    },
                    "40%": {
                        transform: "translateY(-24px)",
                        "animation-timing-function": "ease-in"
                    },
                    "65%": {
                        transform: "translateY(-12px)",
                        "animation-timing-function": "ease-in"
                    },
                    "82%": {
                        transform: "translateY(-6px)",
                        "animation-timing-function": "ease-in"
                    },
                    "93%": {
                        transform: "translateY(-4px)",
                        "animation-timing-function": "ease-in"
                    },
                    "25%,55%,75%,87%": {
                        transform: "translateY(0)",
                        "animation-timing-function": "ease-out"
                    },
                    to: {
                        transform: "translateY(0)",
                        "animation-timing-function": "ease-out",
                        opacity: "1"
                    }
                }
            }
        },
    },



    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'),require("daisyui")],
};
