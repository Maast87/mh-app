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
        { label: "ik loop vast", href: "/ik-loop-vast" },
        { label: "zelfcheck ik loop vast" },
    ];
    provide('breadcrumbs', breadcrumbs);
</script>

<template>
    <Layout>
        <Head title="Home" />

        <GradientHero>
            <template v-slot:subtitle>
                Mentale EHBO
            </template>
            <template v-slot:title>
                Zelfcheck voor wanneer<br> je mentaal vastloopt
            </template>
        </GradientHero>

        <DarkblueElement class="pb-4">
            <p class="text-header_l text-gray-100 font-bold text-center">
                Ontdek hoe je nu het<br><span class="gradient-text">beste</span> verder kunt gaan
            </p>

            <GradientElement>
                <GradientWhiteElement>
                    Hier komt de zelfcheck
                </GradientWhiteElement>
            </GradientElement>

        </DarkblueElement>
    </Layout>
</template>

<style scoped>

</style>
