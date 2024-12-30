<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import {provide} from "vue";
    import GradientHero from "@/Components/PageLayoutElements/GradientHero.vue";
    import DarkblueElement from "@/Components/PageLayoutElements/DarkblueElement.vue";
    import ButtonThree from "@/Components/Buttons/ButtonThree.vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "ondersteuning", href: "/ondersteuning" },
        { label: "supportgroepen" },
    ];
    provide('breadcrumbs', breadcrumbs);
</script>

<template>
    <Layout>
        <Head title="Supportgroepen" />

        <GradientHero>
            <template v-slot:subtitle>
                Lees tips van anderen en vraag ondersteuning
            </template>
            <template v-slot:title>
                Mental Hygiene<br>supportgroepen
            </template>
        </GradientHero>

        <DarkblueElement>
            <p class="text-header_l text-gray-100 font-bold text-center">
                Supportgroepen per<br><span class="gradient-text">onderwerp</span>
            </p>

            <div class="grid lg:grid-cols-2 grid-cols-1 lg:grid-rows-2 grid-rows-4 grid-flow-col gap-x-8 gap-y-8">
                <div id="card">
                    <div class="mb-[-10px] z-0">
                        <img
                            src="../../../images/mental-hygiene-vormgeving-brian-me-learning.png"
                            alt="Mental Hygiene afbeelding me-learning"
                            class="rounded-tl-xl rounded-tr-xl"
                        >
                    </div>
                    <div class="border border-gray-100 bg-blue_700_blue_900 p-3 rounded-xl z-1 relative">
                        <h2 class="text-gray-100 font-bold text-header_s">Hier een het is nog leeg</h2>
                        <p class="text-gray-100 mb-4">
                            HIER EEN CARD 'HET IS NOG WAT LEEG'
                            Oude tekst: Zodra je een me-learning koopt, komt de supportgroep die daarbij hoort hier in het rijtje te staan.
                        </p>
                        <ButtonThree href="#" title="Naar de groep (nog linken)"/>
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
                        <h2 class="text-gray-100 font-bold text-header_s">Supportgroep titel</h2>
                        <p class="text-gray-100 mb-4">
                            Als je er behoefte aan hebt, dan kun je in de supportgroep anderen in vergelijkbare situaties om advies en tips vragen.
                        </p>
                        <ButtonThree href="#" title="Naar de groep (nog linken)"/>
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
                        <h2 class="text-gray-100 font-bold text-header_s">Supportgroep titel</h2>
                        <p class="text-gray-100 mb-4">
                            Als je er behoefte aan hebt, dan kun je in de supportgroep anderen in vergelijkbare situaties om advies en tips vragen.
                        </p>
                        <ButtonThree href="#" title="Naar de groep (nog linken)"/>
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
                        <h2 class="text-gray-100 font-bold text-header_s">Supportgroep titel</h2>
                        <p class="text-gray-100 mb-4">
                            Als je er behoefte aan hebt, dan kun je in de supportgroep anderen in vergelijkbare situaties om advies en tips vragen.
                        </p>
                        <ButtonThree href="#" title="Naar de groep (nog linken)"/>
                    </div>
                </div>
            </div>
        </DarkblueElement>
    </Layout>
</template>
