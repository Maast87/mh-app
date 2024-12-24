<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import {Head} from "@inertiajs/vue3";
    import {provide} from "vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "voorwaarden" },
    ];
    provide('breadcrumbs', breadcrumbs);
</script>

<template>
    <Layout>
        <Head title="Voorwaarden" />
        <p>Voorwaarden</p>
    </Layout>
</template>
