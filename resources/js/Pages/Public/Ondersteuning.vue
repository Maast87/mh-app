<script setup>
    import Layout from "../Shared/Layout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import GradientHero from "@/Components/PageLayoutElements/GradientHero.vue";
    import DarkblueElement from "@/Components/PageLayoutElements/DarkblueElement.vue";
    import {provide} from "vue";
    import ButtonThree from "@/Components/Buttons/ButtonThree.vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "ik loop vast" },
    ];
    provide('breadcrumbs', breadcrumbs);
</script>

<template>
    <Layout>
        <Head tag="Ik loop vast" />

        <GradientHero>
            <template v-slot:subtitle>
                Praktische tips voor wanneer je vastloopt
            </template>
            <template v-slot:title>
                Ondersteuning
            </template>
        </GradientHero>

        <DarkblueElement class="pb-4">
            <p class="text-header_l text-gray-100 font-bold text-center">
                Al onze vormen <br>van <span class="gradient-text">ondersteuning</span>
            </p>
            <div class="grid lg:grid-cols-2 grid-cols-1 lg:grid-rows-1 grid-rows-4 grid-flow-col gap-x-8 gap-y-8">
                <div id="card">
                    <div class="mb-[-10px] z-0">
                        <img
                            src="../../../images/mental-hygiene-vormgeving-brian-me-learning.png"
                            alt="Mental Hygiene afbeelding me-learning"
                            class="rounded-tl-xl rounded-tr-xl"
                        >
                    </div>
                    <div class="border border-gray-100 bg-blue_700_blue_900 p-3 rounded-xl z-1 relative">
                        <h2 class="text-gray-100 font-bold text-header_s">Supportgroepen</h2>
                        <p class="text-gray-100 mb-4">
                            Voor elk van de onderwerpen waar je mee bezig bent (geweest) is er een supportgroep. Daarin kun je vragen stellen en tips lezen van anderen die met hetzelfde onderwerp bezig zijn.
                        </p>
                        <ButtonThree href="/ondersteuning/supportgroepen" title="Naar de supportgroepen"/>
                    </div>
                </div>
                <div id="card">
                    <div class="mb-[-10px] z-0">
                        <img
                            src="../../../images/mental-hygiene-vormgeving-brian-1-op-1-coaching.png"
                            alt="Mental Hygiene afbeelding me-learning"
                            class="rounded-tl-xl rounded-tr-xl"
                        >
                    </div>
                    <div class="border border-gray-100 bg-blue_700_blue_900 p-3 rounded-xl z-1 relative">
                        <h2 class="text-gray-100 font-bold text-header_s">1-op-1 coaching</h2>
                        <p class="text-gray-100 mb-4">
                            Tijdens een 1-op-1 coaching sessie ga je in gesprek met een Mental Hygiene expert. Hij/zij helpt je met de dingen waar je tegenaan loopt. Je kunt de sessie online, telefonisch of fysiek doen. Voor 1-op-1 coaching rekenen we een apart tarief.
                        </p>
                        <ButtonThree href="/ondersteuning/coaching" title="Naar 1-op-1 coaching"/>
                    </div>
                </div>
            </div>
        </DarkblueElement>
    </Layout>
</template>
