<script setup>
    import Layout from "../Pages/Shared/Layout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import {provide} from "vue";
    import ProfileLayout from "@/Pages/Shared/ProfileLayout.vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "profiel" }
    ];
    provide('breadcrumbs', breadcrumbs);
</script>

<template>
    <Layout>
        <Head title="Profiel" />

        <div class="flex flex-col w-full">
            <ProfileLayout />
            <div class="flex w-full gap-x-4 p-6 bg-gray-100 rounded-xl">
                <div class="w-full">
                    <div>
                        <img
                            src="../../images/mental-hygiene-vormgeving-profiel-tab-resultaten.png"
                            alt="Mental Hygiene afbeelding resultaten"
                            class="rounded-tl-lg rounded-tr-lg"
                        >
                    </div>
                    <div class="border border-gray-300 bg-gray-100 rounded-lg p-3 mt-[-6px] z-1 relative">
                        <h3 class="text-header_s">Resultaten</h3>
                        <p>Bekijk al jouw resultaten</p>
                        <Link href="/profiel/resultaten">
                            <button class="button-primary w-full mt-4">Naar resultaten</button>
                        </Link>
                    </div>
                </div>
                <div class="w-full">
                    <div>
                        <img
                            src="../../images/mental-hygiene-vormgeving-profiel-tab-instellingen.png"
                            alt="Mental Hygiene afbeelding instellingen"
                            class="rounded-tl-lg rounded-tr-lg"
                        >
                    </div>
                    <div class="border border-gray-300 bg-gray-100 rounded-lg p-3 mt-[-6px] z-1 relative">
                        <h3 class="text-header_s">Instellingen</h3>
                        <p>Bekijk al jouw instellingen</p>
                        <Link href="/profiel/instellingen">
                            <button class="button-primary w-full mt-4">Naar instellingen</button>
                        </Link>
                    </div>
                </div>
                <div class="w-full">
                    <div>
                        <img
                            src="../../images/mental-hygiene-vormgeving-profiel-tab-lidmaatschap.png"
                            alt="Mental Hygiene afbeelding lidmaatschap"
                            class="rounded-tl-lg rounded-tr-lg"
                        >
                    </div>
                    <div class="border border-gray-300 bg-gray-100 rounded-lg p-3 mt-[-6px] z-1 relative">
                        <h3 class="text-header_s">Lidmaatschap</h3>
                        <p>Bekijk jouw lidmaatschap</p>
                        <Link href="/profiel/lidmaatschap">
                            <button class="button-primary w-full mt-4">Naar lidmaatschap</button>
                        </Link>
                    </div>
                </div>
            </div>
        </div>


    </Layout>
</template>

<style scoped>

</style>
