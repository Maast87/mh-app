<script setup>
import { useTheme } from "../../composables/useTheme";

const { dark, toggleTheme } = useTheme();
</script>

<template>
    <button
        class="flex items-center justify-center w-[36px] h-[36px] rounded-lg hover:bg-gray_300_blue_900 border border-gray_100_blue_900 hover:border-gray-300 hover:translate-y-[-2px] hover:shadow-mh_box_shadow active:translate-y-[0px] active:shadow-mh_box_shadow_off transition ease-in-out duration-300"
        @click="toggleTheme"
    >
        <!-- Sun icon for dark mode -->
        <svg
            class="absolute transition-opacity duration-300"
            :class="{ 'opacity-100': dark, 'opacity-0': !dark }"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            aria-hidden="true"
        >
            <path
                d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                stroke-linecap="round"
                stroke-width="1.5"
                stroke="var(--mh-gray-100)"
                stroke-linejoin="round"
            />
        </svg>

        <!-- Moon icon for light mode -->
        <svg
            class="absolute transition-opacity duration-300"
            :class="{ 'opacity-100': !dark, 'opacity-0': dark }"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            aria-hidden="true"
        >
            <path
                d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z"
                stroke-linecap="round"
                stroke-width="1.5"
                stroke="var(--mh-blue-700)"
                stroke-linejoin="round"
            />
        </svg>
    </button>
</template>
