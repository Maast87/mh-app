<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import {Head} from "@inertiajs/vue3";
    import {provide} from "vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "me-learning", href: "/me-learning" },
        { label: "les" },
    ];
    provide('breadcrumbs', breadcrumbs);
</script>

<template>
    <Layout>
        <Head title="Les" />
        <p>Les</p>
    </Layout>
</template>
