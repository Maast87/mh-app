<script setup>
    import Layout from "../Shared/Layout.vue";
    import { Head, Link, useForm } from "@inertiajs/vue3";
    import GradientHero from "../../Components/PageLayoutElements/GradientHero.vue";
    import DarkblueElement from "../../Components/PageLayoutElements/DarkblueElement.vue";
    import {provide, ref} from "vue";
    import ButtonThree from "@/Components/Buttons/ButtonThree.vue";
    import ButtonFour from "@/Components/Buttons/ButtonFour.vue";
    import ButtonSix from "@/Components/Buttons/ButtonSix.vue";
    import PricingCards from "@/Pages/Shared/PricingCards.vue";
    import { useAchievementModal } from '@/Utilities/composables/useAchievementModal';

    const breadcrumbs = [
        { label: "  home" }
    ];
    provide('breadcrumbs', breadcrumbs);

    const { showAchievement } = useAchievementModal();

    const testAchievement = () => {
        showAchievement({
            name: 'Test Achievement',
            description: 'This is a test achievement to verify the modal works',
            tier_name: 'Level 1'
        });
    };

    const confettiRef = ref(null);

    const testConfetti = () => {
        if (confettiRef.value) {
            confettiRef.value.startAnimation();
        }
    };
</script>

<template>
    <Layout>
        <Head title="Home" />

        <div class="flex flex-col w-full">
            <div v-if="!$page.props.auth.user">

                <div class="flex flex-col justify-center items-center w-full px-10 pt-20 pb-20 gap-y-4">
                    <h1 class="text-header_xl text-blue_700_gray_100 text-center">Welkom bij het<br><span class="gradient-text">Mental Hygiene</span> platform</h1>
                    <p class="text-base text-blue_700_gray_100">Hier volg je de me-learning; de meest interactieve online training over mentale ontwikkeling</p>
                    <div class="flex gap-x-4 mt-4">
                        <ButtonFour href="/login" title="Log in"/>
                        <ButtonSix href="/registreren" title="Start gratis"/>
                    </div>
                </div>

                <DarkblueElement class="items-center rounded-xl gap-y-0">
                    <h2 id="zo-werkt-het" class="text-header_m text-gray-100 text-center pb-12">Het <span class="gradient-text">resultaat</span> en de werkwijze <br>van de me-learning in beeld</h2>
                    <div class="w-[90%]">
                        <div style="position:relative; padding-top:56.25%;">
                            <iframe
                                src="https://iframe.mediadelivery.net/embed/360263/5c4ae94a-3198-4300-a2e3-86a5dceead21?autoplay=true&loop=false&muted=false&preload=true&responsive=true"
                                loading="eager"
                                style="border: 0; position: absolute; top: 0; height: 100%; width: 100%; border-radius: 0.75rem"
                                allow="accelerometer;gyroscope;encrypted-media;picture-in-picture;"
                                allowfullscreen="true"
                            ></iframe>
                        </div>
                    </div>

                    <h2 id="prijzen" class="text-header_m text-gray-100 text-center pb-12 pt-20">Sluit je aan bij <span class="gradient-text">Mental Hygiene</span></h2>

                    <PricingCards :pricing="$page.props.pricing" />

                </DarkblueElement>

                <div class="flex flex-col items-center pt-16 pb-10">
                    <h2 id="visie" class="text-header_m text-blue_700_gray_100 text-center pb-12">Onze visie voor een<br> <span class="gradient-text">fijne</span> wereld in beeld</h2>
                    <div class="w-[90%]">
                        <div style="position:relative; padding-top:56.25%;">
                            <iframe
                                src="https://iframe.mediadelivery.net/embed/360263/5c4ae94a-3198-4300-a2e3-86a5dceead21?autoplay=true&loop=false&muted=false&preload=true&responsive=true"
                                loading="eager"
                                style="border: 0; position: absolute; top: 0; height: 100%; width: 100%; border-radius: 0.75rem"
                                allow="accelerometer;gyroscope;encrypted-media;picture-in-picture;"
                                allowfullscreen="true"
                            ></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="$page.props.auth.user">

                <GradientHero>
                    <template v-slot:subtitle>
                        Alles over mentale ontwikkeling op één plek
                    </template>
                    <template v-slot:title>
                        Welkom bij het <br> Mental Hygiene platform
                    </template>
                </GradientHero>

                <DarkblueElement class="pb-4">
                    <p class="text-header_l text-gray-100 font-bold text-center">
                        Hi <span class="gradient-text">{{ $page.props.auth.user.name }},</span><br>wat wil je doen?
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
                                <h2 class="text-gray-100 font-bold text-header_s">Me-learning</h2>
                                <p class="text-gray-100 mb-4">
                                    De praktische training over mentale uitdagingen. Te volgen op je eigen tempo, en altijd relevant voor jouw persoonlijk situatie.
                                </p>
                                <ButtonThree href="/me-learning" title="Naar de me-learning" />
                            </div>
                        </div>
                        <div id="card">
                            <div class="mb-[-10px] z-0">
                                <img
                                    src="../../../images/mental-hygiene-vormgeving-brian-support.png"
                                    alt="Mental Hygiene afbeelding me-learning"
                                    class="rounded-tl-xl rounded-tr-xl"
                                >
                            </div>
                            <div class="border border-gray-100 bg-blue_700_blue_900 p-3 rounded-xl z-1 relative">
                                <h2 class="text-gray-100 font-bold text-header_s">Ondersteuning</h2>
                                <p class="text-gray-100 mb-4">
                                    Van 1-op-1 coaching tot supportgroepen en meer; onze vormen van ondersteuning vind je hier.
                                </p>
                                <ButtonThree href="/ondersteuning" title="Naar ondersteuning" />
                            </div>
                        </div>
                        <div id="card">
                            <div class="mb-[-10px] z-0">
                                <img
                                    src="../../../images/mental-hygiene-vormgeving-brian-progressie.png"
                                    alt="Mental Hygiene afbeelding me-learning"
                                    class="rounded-tl-xl rounded-tr-xl"
                                >
                            </div>
                            <div class="border border-gray-100 bg-blue_700_blue_900 p-3 rounded-xl z-1 relative">
                                <h2 class="text-gray-100 font-bold text-header_s">Resultaten</h2>
                                <p class="text-gray-100 mb-4">
                                    Al jouw doelen, sterke kanten en uitdagingen en ingevulde oefeningen vind je hier.
                                </p>
                                <ButtonThree href="/profiel/resultaten" title="Naar resultaten" />
                            </div>
                        </div>
                        <div id="card">
                            <div class="mb-[-10px] z-0">
                                <img
                                    src="../../../images/mental-hygiene-vormgeving-brian-visie.png"
                                    alt="Mental Hygiene afbeelding me-learning"
                                    class="rounded-tl-xl rounded-tr-xl"
                                >
                            </div>
                            <div class="border border-gray-100 bg-blue_700_blue_900 p-3 rounded-xl z-1 relative">
                                <h2 class="text-gray-100 font-bold text-header_s">Visie van Mental Hygiene</h2>
                                <p class="text-gray-100 mb-4">
                                    Bekijk hoe een wereld met Mental Hygiene eruit ziet, en hoe je met ons bijdraagt aan die visie.
                                </p>
                                <a href="https://mentalhygiene.me/over-mental-hygiene-onze-visie/" target="_blank">
                                    <button class="flex items-center gap-x-1 justify-center button-three w-full">
                                        <div>
                                            <p class="text-button_text_s">Naar de visie</p>
                                        </div>
                                        <div>
                                            <svg
                                                class="group-hover:translate-x-[3px] mh-transition"
                                                width="20"
                                                height="20"
                                                fill="var(--mh-blue-700)"
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

                    <div v-if="$page.props.auth.user && !$page.props.auth.user.subscribed">
                        <p id="prijzen" class="text-header_m text-gray-100 text-center pb-10">Sluit je aan bij <span class="gradient-text">Mental Hygiene</span></p>

                        <PricingCards :pricing="$page.props.pricing" />
                    </div>

                </DarkblueElement>

                <div class="flex flex-col gap-y-4">
                    <button
                        class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                        @click="testAchievement"
                    >
                        Test Achievement Modal
                    </button>
                    
                    <button
                        class="rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600"
                        @click="testConfetti"
                    >
                        Test Confetti
                    </button>
                </div>
            </div>
        </div>
    </Layout>
</template>
