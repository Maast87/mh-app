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
        { label: "antwoorden" }
    ];
    provide('breadcrumbs', breadcrumbs);

    const props = defineProps({
        requestedTagname: String,
    });

    useCurrentUser(props.requestedTagname);
</script>

<template>
    <Layout>
        <Head title="Profiel resultaten antwoorden" />

        <div class="flex flex-col w-full">
            <ProfileLayout :requestedTagname="requestedTagname" />
            <p>Pagina Mijn Antwoorden</p>
        </div>
    </Layout>
</template>
