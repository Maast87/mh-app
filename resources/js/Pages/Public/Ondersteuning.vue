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
            <div class="grid lg:grid-cols-2 grid-cols-1 lg:grid-rows-2 grid-rows-4 grid-flow-row gap-x-8 gap-y-8">
                <div id="card">
                    <div class="mb-[-10px] z-0">
                        <img
                            src="../../../images/mental-hygiene-vormgeving-brian-support.png"
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
                <div id="card">
                    <div class="mb-[-10px] z-0">
                        <img
                            src="../../../images/mental-hygiene-vormgeving-brian-faq.png"
                            alt="Mental Hygiene afbeelding me-learning"
                            class="rounded-tl-xl rounded-tr-xl"
                        >
                    </div>
                    <div class="border border-gray-100 bg-blue_700_blue_900 p-3 rounded-xl z-1 relative">
                        <h2 class="text-gray-100 font-bold text-header_s">Bekijk veelgestelde vragen</h2>
                        <p class="text-gray-100 mb-4">
                            Neem een kijkje bij onze veelgestelde vragen.
                        </p>
                        <a href="https://mentalhygiene.me/veelgestelde-vragen/" target="_blank">
                            <button class="flex items-center gap-x-1 justify-center button-three w-full">
                                <div>
                                    <p class="text-button_text_s">Naar veelgestelde vragen</p>
                                </div>
                                <div>
                                    <svg
                                        class="group-hover:translate-x-[3px] mh-transition"
                                        width="20"
                                        height="20"
                                        fill="var(--mh-blue-700-gray-100)"
                                        data-name="Content"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 128 128"
                                    >
                                        <path
                                            d="M96.38,65.9c2.1,0,3.81,1.71,3.81,3.81v22.86c0,6.3-5.13,11.43-11.43,11.43h-53.33c-6.3,0-11.43-5.13-11.43-11.43v-53.33c0-6.3,5.13-11.43,11.43-11.43h22.86c2.1,0,3.81,1.71,3.81,3.81s-1.71,3.81-3.81,3.81h-22.86c-2.1,0-3.81,1.71-3.81,3.81v53.33c0,2.1,1.71,3.81,3.81,3.81h53.33c2.1,0,3.81-1.71,3.81-3.81v-22.86c0-2.1,1.71-3.81,3.81-3.81Z"
                                            stroke="var(--mh-gray-100-blue-900)"
                                            stroke-width="1px"
                                        />
                                        <path
                                            d="M100.19,24c2.1,0,3.81,1.71,3.81,3.81v22.86c0,2.1-1.71,3.81-3.81,3.81s-3.81-1.71-3.81-3.81v-13.66l-31.59,31.59c-.74.74-1.72,1.12-2.69,1.12s-1.95-.37-2.69-1.12c-1.49-1.49-1.49-3.9,0-5.39l31.59-31.59h-13.66c-2.1,0-3.81-1.71-3.81-3.81s1.71-3.81,3.81-3.81h22.86Z"
                                            stroke="var(--mh-gray-100-blue-900)"
                                            stroke-width="1px"
                                        />
                                    </svg>
                                </div>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </DarkblueElement>
    </Layout>
</template>
