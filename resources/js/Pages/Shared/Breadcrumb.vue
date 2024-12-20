<script setup>
    import { Link } from "@inertiajs/vue3";
    import {inject} from "vue";

    const breadcrumbs = inject("breadcrumbs")

    function goBack(event) {
        event.preventDefault();
        window.history.back();
    }
</script>

<template>
    <div>
        <button
            id="previous"
            @click="goBack"
            class="flex flex-row gap-x-3 button-quaternary"
        >
            <div>
                <svg
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M15.75 19.5 8.25 12l7.5-7.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke="#0E122C"
                        stroke-width="2"
                    />
                </svg>
            </div>
            <p class="text-blue-800">Vorige pagina</p>
        </button>
    </div>
    <div class="flex items-center pl-3 border-0 border-l border-blue-700">
        <p>
            <template v-for="(item, index) in breadcrumbs" :key="index">
                <Link
                    v-if="item.href"
                    :href="item.href"
                    class="link-underline-green"
                >
                    {{ item.label }}
                </Link>
                <span v-else class="font-semibold text-blue-700">
                    {{ item.label }}
                </span>
                <span
                    v-if="index < breadcrumbs.length - 1"
                    class="text-blue-700 mx-1"
                >
                    -
                </span>
            </template>
        </p>
    </div>
</template>

<style scoped>

</style>
