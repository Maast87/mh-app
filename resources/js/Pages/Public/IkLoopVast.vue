<script setup>
    import Layout from "../Shared/Layout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import {provide} from "vue";
    import GradientHero from "@/Components/PageLayoutElements/GradientHero.vue";
    import DarkblueElement from "@/Components/PageLayoutElements/DarkblueElement.vue";
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
                We zijn er voor je, in welke vorm je ook nodig hebt
            </template>
            <template v-slot:title>
                Help, ik loop vast
            </template>
        </GradientHero>

        <DarkblueElement class="pb-4">
            <p class="text-header_l text-gray-100 font-bold text-center">
                <span class="gradient-text">Waarop</span> loop je vast?
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
                        <h2 class="text-gray-100 font-bold text-header_s">Ik loop mentaal vast</h2>
                        <p class="text-gray-100 mb-4">
                            In dit geval raden we je aan de korte zelfcheck 'ik loop vast' te doen. Hiermee krijg je inzicht in hoe je nu verder kunt gaan.
                        </p>
                        <ButtonThree href="/zelfcheck-ik-loop-vast" title="Naar de zelfcheck" />
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
                        <h2 class="text-gray-100 font-bold text-header_s">Ik begrijp het platform niet</h2>
                        <p class="text-gray-100 mb-4">
                            Neem dan een kijkje bij onze veelgestelde vragen, of stuur ons een berichtje met je vraag.
                        </p>
                        <a href="https://mentalhygiene.me/veelgestelde-vragen/" target="_blank">
                            <button class="button-three w-full mb-4">
                                <p class="text-button_text_s">Naar de veelgestelde vragen</p>
                            </button>
                        </a>
                        <ButtonThree href="/contact" title="Neem contact op" />
                    </div>
                </div>
            </div>
        </DarkblueElement>
    </Layout>
</template>
