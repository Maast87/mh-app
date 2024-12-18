<script setup>
    import Layout from "../Pages/Shared/Layout.vue";
    import { Head } from "@inertiajs/vue3";
    import {provide} from "vue";
    import CheckInterface from "@/Components/CheckInterface.vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "dashboard", href: "/dashboard" },
        { label: "homepage" }
    ];
    provide('breadcrumbs', breadcrumbs);


</script>

<template>
    <Layout>
        <Head tag="Me-learning"/>

        <CheckInterface store="dummyCheckQuestions" />

    </Layout>
</template>
