<script setup>
    import {Head, Link} from "@inertiajs/vue3";
    import Layout from "@/Pages/Shared/Layout.vue";
    import {provide} from "vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "contact" },
    ];
    provide('breadcrumbs', breadcrumbs);
</script>

<template>
    <Layout>
        <Head tag="Contact" />
        <div>
            <p>
                Contact
            </p>
        </div>
    </Layout>
</template>
