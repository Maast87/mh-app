<script setup>
    import {Head} from "@inertiajs/vue3";
    import ProfileLayout from "@/Pages/Shared/ProfileLayout.vue";
    import Layout from "@/Pages/Shared/Layout.vue";
    import {provide} from "vue";
    import {useCurrentUser} from "@/Utilities/composables/useCurrentUser.js";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "profiel", href: "/profiel" },
        { label: "resultaten", href: "/profiel/resultaten" },
        { label: "statistieken" }
    ];
    provide('breadcrumbs', breadcrumbs);

    const props = defineProps({
        requestedUserId: String,
    });

    const {isAuthenticatedUser, authenticatedUserId } = useCurrentUser(props.requestedUserId);
</script>

<template>
    <Layout>
        <Head tag="Statistieken" />

        <div class="flex flex-col w-full">
            <ProfileLayout :requestedUserId="requestedUserId" :isAuthenticatedUser="isAuthenticatedUser" />
            <p>Pagina Mijn Statistieken</p>
        </div>
    </Layout>
</template>
