<script setup>
    import Layout from "../Shared/Layout.vue";
    import { Head, Link } from "@inertiajs/vue3";
    import GradientHero from "../../Components/PageLayoutElements/GradientHero.vue";
    import DarkblueElement from "../../Components/PageLayoutElements/DarkblueElement.vue";
    import GradientWhiteElement from "@/Components/PageLayoutElements/GradientWhiteElement.vue";
    import GradientElement from "@/Components/PageLayoutElements/GradientElement.vue";
    import {provide, ref} from "vue";
    import ButtonThree from "@/Components/Buttons/ButtonThree.vue";
    import ButtonFour from "@/Components/Buttons/ButtonFour.vue";
    import ButtonSix from "@/Components/Buttons/ButtonSix.vue";
    import DefaultModal from "@/Components/Modals/DefaultModal.vue";
    import ButtonOne from "@/Components/Buttons/ButtonOne.vue";

    const breadcrumbs = [
        { label: "  home" }
    ];
    provide('breadcrumbs', breadcrumbs);

    const isModalVisible = ref(false);

    const openModal = () => {
        isModalVisible.value = true;
    };

    const closeModal = () => {
        isModalVisible.value = false;
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
                    <GradientElement class="flex gap-x-4 gap-y-4 w-full">
                            <GradientWhiteElement class="flex gap-y-6 h-fit text-blue_700_gray_100">
                                <div class="flex flex-col gap-y-3">
                                    <p class="text-header_s">Starter account</p>
                                    <p class="text-header_m leading-4">€0,-<span class="text-base"> voor altijd</span></p>
                                    <p class="text-base font-medium">Je hebt:</p>
                                    <div class="flex items-center gap-x-2">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="var(--mh-green-100)"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            class="size-5 ml-2"
                                        >
                                            <path
                                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </svg>
                                        <p class="text-base">Toegang tot het Mental Hygiene Platform</p>
                                    </div>
                                    <div class="flex items-center gap-x-2">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="var(--mh-green-100)"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            class="size-5 ml-2"
                                        >
                                            <path
                                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </svg>
                                        <p class="text-base">Toegang tot de zelfchecks</p>
                                    </div>
                                    <p class="text-base font-medium pt-2 border border-0 border-t border-blue-700-gray-100">Aanvullend op het platform te bestellen</p>
                                    <div class="flex items-center gap-x-2">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="var(--mh-blue-100)"
                                            class="size-5 ml-2"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        <p class="text-base">Premium lidmaatschap voor toegang tot de me-learning (€19,99 per maand)</p>
                                    </div>
                                    <div class="flex items-center gap-x-2">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="var(--mh-blue-100)"
                                            class="size-5 ml-2"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        <p class="text-base">1-op-1 coaching voor als je vastloopt (€74,99 per 60 minuten)</p>
                                    </div>
                                </div>
                                <div>
                                    <ButtonOne href="/registreren" title="Maak gratis een account" />
                                </div>
                            </GradientWhiteElement>
                            <GradientWhiteElement class="text-blue_700_gray_100">
                                <p class="text-header_s">Premium lidmaatschap*</p>
                                <p class="text-header_m leading-4">€19,99<span class="text-base">/mnd**</span></p>
                                <p class="text-base font-medium">Je hebt:</p>
                                <div class="flex items-center gap-x-2">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="var(--mh-green-100)"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        class="size-5 ml-2"
                                    >
                                        <path
                                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="text-base">Toegang tot het Mental Hygiene Platform</p>
                                </div>
                                <div class="flex items-center gap-x-2">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="var(--mh-green-100)"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        class="size-5 ml-2"
                                    >
                                        <path
                                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="text-base">Toegang tot de zelfchecks</p>
                                </div>
                                <div class="flex items-center gap-x-2">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="var(--mh-green-100)"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        class="size-5 ml-2"
                                    >
                                        <path
                                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="text-base">Toegang tot de Me-learning</p>
                                </div>
                                <div class="flex items-center gap-x-2">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="var(--mh-green-100)"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        class="size-5 ml-2"
                                    >
                                        <path
                                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    <p class="text-base">Toegang tot relevante supportgroepen</p>
                                </div>
                                <p class="text-base font-medium pt-2 border border-0 border-t border-blue-700-gray-100">Aanvullend op het platform te bestellen</p>
                                <div class="flex items-center gap-x-2">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="var(--mh-blue-100)"
                                        class="size-5 ml-2"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    <p class="text-base">1-op-1 coaching voor als je vastloopt (€74,99 per 60 minuten)</p>
                                </div>
                                <div class="flex flex-col gap-y-1 pt-2 border border-0 border-t border-blue-700-gray-100">
                                    <p class="text-base italic">* om dit lidmaatschap af te sluiten heb je een Starter account nodig.</p>
                                    <p class="text-base italic">** je kunt starten en stoppen met het Premium lidmaatschap wanneer jij wil.</p>
                                </div>
                            </GradientWhiteElement>
                    </GradientElement>
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
                                    src="../../../images/mental-hygiene-vormgeving-brian-1-op-1-coaching.png"
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
                    <div id="modal-trigger" class="flex justify-center mt-10">
                        <button @click="openModal" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Open Modal
                        </button>
                    </div>

                    <DefaultModal :show="isModalVisible" @close="closeModal">
                        <template #title>
                            Dit is de titel
                        </template>
                        <template #content>
                            <div>
                                <p>Dit is een lijn</p>
                            </div>
                            <div>
                                <p>Dit een tweede lijn</p>
                            </div>
                        </template>
                    </DefaultModal>
                </DarkblueElement>
            </div>
        </div>
    </Layout>
</template>
