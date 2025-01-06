<script setup>
    import Layout from "../Shared/Layout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import {provide} from "vue";
    import ProfileLayout from "@/Pages/Shared/ProfileLayout.vue";
    import PricingCards from "@/Pages/Shared/PricingCards.vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "profiel", href: "/profiel" },
        { label: "lidmaatschap  " }
    ];
    provide('breadcrumbs', breadcrumbs);

    const props = defineProps({
        pricing: Object
    });
</script>

<template>
    <Layout>
        <Head title="Profiel" />

        <div class="flex flex-col w-full">
            <ProfileLayout />

            <PricingCards :pricing="pricing" />
        </div>
    </Layout>
</template>

<style scoped>

</style>
