<script setup>
    import Layout from "../Shared/Layout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import {provide} from "vue";
    import ProfileLayout from "@/Pages/Shared/ProfileLayout.vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "profiel", href: "/profiel" },
        { label: "resultaten" }
    ];
    provide('breadcrumbs', breadcrumbs);
</script>

<template>
    <Layout>
        <Head title="Profiel" />

        <div class="flex flex-col w-full">
            <ProfileLayout />
            <div class="flex w-full gap-x-4 p-6 bg-gray-100 rounded-xl">
                <p>
                    Pagina resultaten, hier komen meer subtabs voor het kiezen van de verschillende resultaten
                </p>
            </div>
        </div>
    </Layout>
</template>

<style scoped>

</style>
