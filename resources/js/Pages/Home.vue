<script setup>
    import Layout from "../Pages/Shared/Layout.vue";
    import { Head } from "@inertiajs/vue3";
    import DarkModeToggle from "@/Components/DarkModeToggle.vue";
    import {provide} from "vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "dashboard", href: "/dashboard" },
        { label: "homepage" }
    ];
    provide('breadcrumbs', breadcrumbs);

</script>

<template>
    <Layout>
        <Head title="Home" />

        <DarkModeToggle />

        <div>
            <h1>Welcome to the Home Page</h1>
        </div>
    </Layout>
</template>
