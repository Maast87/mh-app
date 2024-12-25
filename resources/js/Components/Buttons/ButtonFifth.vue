<script setup>
    import {Link} from "@inertiajs/vue3";

    defineProps({
        title: String,
        href: String,
    });
</script>

<template>
    <Link :href="href">
        <button class="button-tertiary flex gap-x-1 justify-center group">
            <p class="text-button_text_s">{{ title }}</p>
            <div>
                <svg
                    class="group-hover:translate-x-[3px] mh-transition"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke="#0E122C"
                        stroke-width="2"
                    />
                </svg>
            </div>
        </button>
    </Link>
</template>

<style scoped>

</style>
