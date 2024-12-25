<script setup>
    import Layout from "../Shared/Layout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import {provide} from "vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "ik loop vast" },
    ];
    provide('breadcrumbs', breadcrumbs);

</script>

<template>
    <Layout>
        <Head tag="Ik loop vast" />
        <p>Pagina Ik loop vast</p>
    </Layout>
</template>

<style scoped>

</style>
