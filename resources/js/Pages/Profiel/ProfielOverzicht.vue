<script setup>
    import Layout from "../Shared/Layout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import ProfileLayout from "@/Pages/Shared/ProfileLayout.vue";
    import {provide} from "vue";
    import ButtonOne from "@/Components/Buttons/ButtonOne.vue";
    import {useCurrentUser} from "@/Utilities/composables/useCurrentUser.js";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "profiel" }
    ];
    provide('breadcrumbs', breadcrumbs);

    const props = defineProps({
        requestedTagname: String,
    });

    const {isAuthenticatedUser} = useCurrentUser(props.requestedTagname);
</script>

<template>
    <Layout>
        <Head title="Profiel" />

        <div class="flex flex-col w-full">
            <ProfileLayout :requestedTagname="requestedTagname" />
            <div class="flex w-full gap-x-4 p-6 bg-gray-100 rounded-xl">
                <div class="w-full">
                    <div>
                        <img
                            src="../../../images/mental-hygiene-vormgeving-profiel-tab-resultaten.png"
                            alt="Mental Hygiene afbeelding resultaten"
                            class="rounded-tl-lg rounded-tr-lg"
                        >
                    </div>
                    <div class="border border-gray-300 bg-gray-100 rounded-lg p-3 mt-[-6px] z-1 relative">
                        <h3 class="text-header_s">Resultaten</h3>
                        <p class="mb-4">Bekijk al jouw resultaten</p>
                        <ButtonOne :href="`/profiel/${requestedTagname}/resultaten`" title="Naar resultaten" />
                    </div>
                </div>
                <div v-if="isAuthenticatedUser" class="w-full">
                    <div>
                        <img
                            src="../../../images/mental-hygiene-vormgeving-profiel-tab-instellingen.png"
                            alt="Mental Hygiene afbeelding instellingen"
                            class="rounded-tl-lg rounded-tr-lg"
                        >
                    </div>
                    <div class="border border-gray-300 bg-gray-100 rounded-lg p-3 mt-[-6px] z-1 relative">
                        <h3 class="text-header_s">Instellingen</h3>
                        <p class="mb-4">Bekijk al jouw instellingen</p>
                        <ButtonOne :href="`/profiel/${requestedTagname}/instellingen`" title="Naar instellingen" class="mt-4" />
                    </div>
                </div>
                <div v-if="isAuthenticatedUser" class="w-full">
                    <div>
                        <img
                            src="../../../images/mental-hygiene-vormgeving-profiel-tab-lidmaatschap.png"
                            alt="Mental Hygiene afbeelding lidmaatschap"
                            class="rounded-tl-lg rounded-tr-lg"
                        >
                    </div>
                    <div class="border border-gray-300 bg-gray-100 rounded-lg p-3 mt-[-6px] z-1 relative">
                        <h3 class="text-header_s">Lidmaatschap</h3>
                        <p class="mb-4">Bekijk jouw lidmaatschap</p>
                        <ButtonOne :href="`/profiel/${requestedTagname}/lidmaatschap`" title="Naar lidmaatschap" class="mt-4" />
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<style scoped>

</style>
