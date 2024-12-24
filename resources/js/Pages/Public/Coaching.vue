<script setup>
    import Layout from "../Shared/Layout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import {provide} from "vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "ondersteuning", href: "/ondersteuning" },
        { label: "coaching" },
    ];
    provide('breadcrumbs', breadcrumbs);
</script>

<template>
    <Layout>
        <Head tag="Coaching" />
        <p>Pagina Coaching</p>
    </Layout>
</template>

<style scoped>

</style>
