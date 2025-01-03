<script setup>
    import {Link} from "@inertiajs/vue3";

    defineProps({
        href: {
            required: true,
        },
        filled: {
            type: Boolean,
            default: false,
        }
    })
</script>

<template>
    <Link
        :href="href"
        class="whitespace-nowrap mb-2 rounded-full py-0.5 px-2 border border-green-100 text-green-100 hover:bg-blue-700 hover:text-gray-100 hover:border-blue-700"
        :class="{'bg-blue-700 text-gray-100 border-blue-700' : filled }"
    >
        <slot />
    </Link>
</template>
