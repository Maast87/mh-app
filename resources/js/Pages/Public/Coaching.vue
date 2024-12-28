<script setup>
    import {Head, Link} from "@inertiajs/vue3";
    import GradientHero from "@/Components/PageLayoutElements/GradientHero.vue";
    import DarkblueElement from "@/Components/PageLayoutElements/DarkblueElement.vue";
    import GradientElement from "@/Components/PageLayoutElements/GradientElement.vue";
    import GradientWhiteElement from "@/Components/PageLayoutElements/GradientWhiteElement.vue";
    import Layout from "@/Pages/Shared/Layout.vue";
    import {provide} from "vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "ondersteuning", href: "/ondersteuning" },
        { label: "coaching" },
    ];
    provide('breadcrumbs', breadcrumbs);
</script>

<template>
    <Layout>
        <Head title="Home" />

        <GradientHero>
            <template v-slot:subtitle>
                Voor wanneer je behoefte hebt aan 1-op-1 ondersteuning
            </template>
            <template v-slot:title>
                Mental Hygiene<br>coaching
            </template>
        </GradientHero>

        <DarkblueElement class="pb-4">
            <p class="text-header_l text-gray-100 font-bold text-center">
                Een <span class="gradient-text">overzicht</span> van de<br>Mental Hygiene coaches
            </p>

            <GradientElement>
                <GradientWhiteElement>
                    Hier komt een overzicht van de coaches + een filter om snel te zoeken
                </GradientWhiteElement>
            </GradientElement>

        </DarkblueElement>
    </Layout>
</template>

<style scoped>

</style>
