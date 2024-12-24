<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import {Head} from "@inertiajs/vue3";
    import {provide} from "vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "hier werken we aan" },
    ];
    provide('breadcrumbs', breadcrumbs);
</script>

<template>
    <Layout>
        <Head title="Roadmap" />
        <p>Roadmap</p>
    </Layout>
</template>
