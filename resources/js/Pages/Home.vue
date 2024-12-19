<script setup>
    import Layout from "../Pages/Shared/Layout.vue";
    import { Head, Link } from "@inertiajs/vue3";
    import {provide} from "vue";
    import GradientHero from "@/Components/GradientHero.vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "dashboard", href: "/dashboard" },
        { label: "homepage" }
    ];
    provide('breadcrumbs', breadcrumbs);

</script>

<template>
    <Layout>
        <Head title="Home" />

        <div class="flex flex-col w-full">
            <GradientHero>
                <template v-slot:subtitle>
                    Alles over mentale ontwikkeling op één plek
                </template>
                <template v-slot:title>
                    Welkom bij het <br> Mental Hygiene platform
                </template>
            </GradientHero>

            <div class="flex flex-col bg-blue-700 pt-16 pb-2 px-8 gap-y-16 rounded-bl-xl rounded-br-xl">
                <p class="text-header_l text-gray-100 font-bold text-center">
                    Hi <span class="gradient-text">{{ $page.props.auth.user.name }},</span><br>wat wil je doen?
                </p>
                <div class="grid lg:grid-cols-2 grid-cols-1 lg:grid-rows-2 grid-rows-4 grid-flow-col gap-x-8 gap-y-8">
                    <div id="card">
                        <div class="mb-[-10px] z-0">
                            <img
                                src="../../images/mental-hygiene-vormgeving-brian-me-learning.png"
                                alt="Mental Hygiene afbeelding me-learning"
                                class="rounded-tl-xl rounded-tr-xl"
                            >
                        </div>
                        <div class="border border-gray-100 bg-blue-700 p-3 rounded-xl z-1 relative">
                            <h2 class="text-gray-100 font-bold text-header_s">Me-learning</h2>
                            <p class="text-gray-100 mb-4">
                                De laagdrempelige en praktische training over mentale uitdagingen. Te volgen op je eigen tempo, en altijd relevant voor jouw persoonlijk situatie.
                            </p>
                            <Link href="/me-learning">
                                <button class="button-tertiary flex gap-x-1 justify-center group">
                                    <p class="text-button_text_s">Naar de me-learning</p>
                                    <div>
                                        <svg
                                            class="group-hover:translate-x-[3px] mh-transition"
                                            width="16"
                                            height="16"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke="#0E122C"
                                                stroke-width="2"
                                            />
                                        </svg>
                                    </div>
                                </button>
                            </Link>
                        </div>
                    </div>
                    <div id="card">
                        <div class="mb-[-10px] z-0">
                            <img
                                src="../../images/mental-hygiene-vormgeving-brian-1-op-1-coaching.png"
                                alt="Mental Hygiene afbeelding me-learning"
                                class="rounded-tl-xl rounded-tr-xl"
                            >
                        </div>
                        <div class="border border-gray-100 bg-blue-700 p-3 rounded-xl z-1 relative">
                            <h2 class="text-gray-100 font-bold text-header_s">Ondersteuning</h2>
                            <p class="text-gray-100 mb-4">
                                Van 1-op-1 coaching tot supportgroepen en meer; onze vormen van ondersteuning vind je hier.
                            </p>
                            <Link href="/ondersteuning">
                                <button class="button-tertiary flex gap-x-1 justify-center group">
                                    <p class="text-button_text_s">Naar ondersteuning</p>
                                    <div>
                                        <svg
                                            class="group-hover:translate-x-[3px] mh-transition"
                                            width="16"
                                            height="16"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke="#0E122C"
                                                stroke-width="2"
                                            />
                                        </svg>
                                    </div>
                                </button>
                            </Link>
                        </div>
                    </div>
                    <div id="card">
                        <div class="mb-[-10px] z-0">
                            <img
                                src="../../images/mental-hygiene-vormgeving-brian-progressie.png"
                                alt="Mental Hygiene afbeelding me-learning"
                                class="rounded-tl-xl rounded-tr-xl"
                            >
                        </div>
                        <div class="border border-gray-100 bg-blue-700 p-3 rounded-xl z-1 relative">
                            <h2 class="text-gray-100 font-bold text-header_s">Resultaten</h2>
                            <p class="text-gray-100 mb-4">
                                Al jouw doelen, sterke kanten en uitdagingen en ingevulde oefeningen vind je hier.
                            </p>
                            <Link href="/al-mijn-resultaten">
                                <button class="button-tertiary flex gap-x-1 justify-center group">
                                    <p class="text-button_text_s">Naar resultaten</p>
                                    <div>
                                        <svg
                                            class="group-hover:translate-x-[3px] mh-transition"
                                            width="16"
                                            height="16"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke="#0E122C"
                                                stroke-width="2"
                                            />
                                        </svg>
                                    </div>
                                </button>
                            </Link>
                        </div>
                    </div>
                    <div id="card">
                        <div class="mb-[-10px] z-0">
                            <img
                                src="../../images/mental-hygiene-vormgeving-brian-visie.png"
                                alt="Mental Hygiene afbeelding me-learning"
                                class="rounded-tl-xl rounded-tr-xl"
                            >
                        </div>
                        <div class="border border-gray-100 bg-blue-700 p-3 rounded-xl z-1 relative">
                            <h2 class="text-gray-100 font-bold text-header_s">Visie van Mental Hygiene</h2>
                            <p class="text-gray-100 mb-4">
                                Bekijk hoe een wereld met Mental Hygiene eruit ziet, en hoe je met ons bijdraagt aan die visie.
                            </p>
                            <Link href="/visie">
                                <button class="button-tertiary flex gap-x-1 justify-center group">
                                    <p class="text-button_text_s">Naar de visie</p>
                                    <div>
                                        <svg
                                            class="group-hover:translate-x-[3px] mh-transition"
                                            width="16"
                                            height="16"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke="#0E122C"
                                                stroke-width="2"
                                            />
                                        </svg>
                                    </div>
                                </button>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </Layout>
</template>
