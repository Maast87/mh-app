<script setup>
    import Layout from "../Shared/Layout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import {provide} from "vue";
    import ProfileLayout from "@/Pages/Shared/ProfileLayout.vue";
    import PricingCards from "@/Pages/Shared/PricingCards.vue";
    import {useCurrentUser} from "@/Utilities/composables/useCurrentUser.js";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "profiel", href: "/profiel" },
        { label: "lidmaatschap  " }
    ];
    provide('breadcrumbs', breadcrumbs);

    const props = defineProps({
        pricing: Object,
        requestedTagname: String,
    });

    // Remove unused variable since we're not passing it to ProfileLayout anymore
    const {isAuthenticatedUser} = useCurrentUser(props.requestedTagname);
</script>

<template>
    <Layout>
        <Head title="Profiel lidmaatschap" />

        <div class="flex flex-col w-full">
            <ProfileLayout :requestedTagname="requestedTagname" />

            <PricingCards :pricing="pricing" />
        </div>
    </Layout>
</template>

<style scoped>

</style>
