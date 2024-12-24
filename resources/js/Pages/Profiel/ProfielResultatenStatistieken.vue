<script setup>
    import {Head} from "@inertiajs/vue3";
    import ProfileLayout from "@/Pages/Shared/ProfileLayout.vue";
    import Layout from "@/Pages/Shared/Layout.vue";
    import {provide} from "vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "profiel", href: "/profiel" },
        { label: "resultaten", href: "/profiel/resultaten" },
        { label: "statistieken" }
    ];
    provide('breadcrumbs', breadcrumbs);
</script>

<template>
    <Layout>
        <Head tag="Statistieken" />

        <div class="flex flex-col w-full">
            <ProfileLayout />
            <p>Pagina Mijn Statistieken</p>
        </div>
    </Layout>
</template>
