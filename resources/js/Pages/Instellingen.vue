<script setup>
    import Layout from "../Pages/Shared/Layout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import {provide} from "vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "profiel", href: "/profiel" },
        { label: "instellingen" }
    ];
    provide('breadcrumbs', breadcrumbs);

</script>

<template>
    <Layout>
        <Head tag="Instellingen" />
        <p>Instellingen</p>
    </Layout>
</template>

<style scoped>

</style>
