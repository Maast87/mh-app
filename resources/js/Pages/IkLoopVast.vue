<script setup>
    import Layout from "../Pages/Shared/Layout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import DarkModeToggle from "@/Components/DarkModeToggle.vue";

    defineOptions({
        layout: Layout
    });
</script>

<template>
    <Head tag="Ik loop vast" />
    <p>Pagina Ik loop vast</p>

    <DarkModeToggle />

</template>

<style scoped>

</style>
