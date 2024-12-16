import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import plugin from "tailwindcss/plugin.js";


/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Montserrat', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                gray: {
                    100: "var(--mh-gray-100)",
                    200: "var(--mh-gray-200)",
                    300: "var(--mh-gray-300)",
                    400: "var(--mh-gray-400)",
                    500: "var(--mh-gray-500)",
                    800: "var(--mh-gray-800)"
                },
                green: {
                    100: "var(--mh-green-100)"
                },
                aqua: {
                    100: "var(--mh-aqua-100)",
                    200: "var(--mh-aqua-200)"
                },
                blue: {
                    100: "var(--mh-blue-100)",
                    600: "var(--mh-blue-600)",
                    700: "var(--mh-blue-700)",
                    800: "var(--mh-blue-800)",
                    900: "var(--mh-blue-900)"
                },
                red: {
                    100: "var(--mh-red-100)",
                    200: "var(--mh-red-200)"
                }
            },

            boxShadow: {
                mh_box_shadow: '0px 3px 2px 0px rgba(0, 0, 0, 0.4)',
                mh_box_shadow_off: '0px 0px 0px 0px rgba(0, 0, 0, 0)'
            },

            textShadow: {
                mh_text_shadow: '0px 3px 2px 0px rgba(0, 0, 0, 0.4)'
            },

            fontSize: {
                header_xl: [
                    'clamp(1.75rem, 0.881rem + 3.659vi, 3.625rem)' /* 28px - 58px */, {
                        lineHeight: '1.2em',
                        fontWeight: '700',
                    }],
                header_l: [
                    'clamp(1.5rem, 0.805rem + 2.927vi, 3rem)' /* 24px - 48px */, {
                    lineHeight: '1.2em',
                    fontWeight: '700',
                }],
                header_m: [
                    'clamp(1.375rem, 0.854rem + 2.195vi, 2.5rem)' /* 22px - 40px */, {
                    lineHeight: '1.3em',
                    fontWeight: '700',
                }],
                header_s: [
                    'clamp(1.25rem, 1.134rem + 0.488vi, 1.5rem)' /* 20px - 24px */, {
                    lineHeight: '1.5em',
                    fontWeight: '700',
                }],
                base: [
                    '1rem', {
                    lineHeight: '1.3em',
                    fontWeight: '400',
                }],
                button_text_l: [
                    'clamp(1rem, 0.884rem + 0.488vi, 1.25rem)'  /* 16px - 20px */, {
                    lineHeight: '1em',
                    fontWeight: '600',
                }],
                button_text_s: [
                    '1rem', {
                    lineHeight: '1em',
                    fontWeight: '600',
                }],
            },
        },
    },

    plugins: [
        forms,
        plugin(({ addBase, theme }) => {
            addBase({
                html: { color: theme("colors.blue-800") },
            });
        }),
    ],
};
