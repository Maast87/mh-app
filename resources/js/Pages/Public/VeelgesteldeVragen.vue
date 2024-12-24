<script setup>
import Layout from "@/Pages/Shared/Layout.vue";
import {Head} from "@inertiajs/vue3";
import {provide} from "vue";

const breadcrumbs = [
    { label: "home", href: "/" },
    { label: "ondersteuning", href: "/ondersteuning" },
    { label: "veelgestelde vragen" },
];
provide('breadcrumbs', breadcrumbs);
</script>

<template>
    <Layout>
        <Head title="Veelgestelde vragen" />
        <p>Veelgestelde vragen</p>
    </Layout>
</template>
