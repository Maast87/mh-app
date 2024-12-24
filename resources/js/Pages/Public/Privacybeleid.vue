<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import {Head} from "@inertiajs/vue3";
    import {provide} from "vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "privacybeleid" },
    ];
    provide('breadcrumbs', breadcrumbs);
</script>

<template>
    <Layout>
        <Head title="Privacybeleid" />
        <p>Privacybeleid</p>
    </Layout>
</template>
