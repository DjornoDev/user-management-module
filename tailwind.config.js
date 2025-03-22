import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

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
                sans: ["Poppins", ...defaultTheme.fontFamily.sans],
                colors: {
                    primary: "#10B981",
                    sidebar: "#ffffff",
                    content: "#f9fafb",
                },
            },
        },
    },

    plugins: [
        forms,
        function ({ addUtilities }) {
            const newUtilities = {
                ".scrollbar-custom": {
                    scrollbarWidth: "thin",
                    scrollbarColor: "#10B981 #f1f1f1",
                    "&::-webkit-scrollbar": {
                        width: "8px",
                        height: "8px",
                    },
                    "&::-webkit-scrollbar-track": {
                        backgroundColor: "#f1f1f1",
                        borderRadius: "10px",
                    },
                    "&::-webkit-scrollbar-thumb": {
                        backgroundColor: "#10B981",
                        borderRadius: "10px",
                    },
                    "&::-webkit-scrollbar-thumb:hover": {
                        backgroundColor: "#0e9f6e",
                    },
                },
            };
            addUtilities(newUtilities, ["responsive", "hover"]);
        },
    ],
};
