<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import { Head, Link } from "@inertiajs/vue3";
    import GradientHero from "@/Components/PageLayoutElements/GradientHero.vue";
    import {provide, ref} from "vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "word lid" }
    ];
    provide('breadcrumbs', breadcrumbs);

    const ButtonOneClicked = ref(false);
    const ButtonTwoClicked = ref(false);
    const DisableButtonOne = ref(false);
    const DisableButtonTwo = ref(false);
    const handleClickButtonOne = () => {
        ButtonOneClicked.value = true;
        ButtonTwoClicked.value = false;
        DisableButtonOne.value = false;
        DisableButtonTwo.value = true;
    };
    const handleClickButtonTwo = () => {
        ButtonOneClicked.value = false;
        ButtonTwoClicked.value = true;
        DisableButtonOne.value = true;
        DisableButtonTwo.value = false;
    };

</script>

<template>
    <Layout>
        <Head title="Word lid" />

        <div class="flex flex-col w-full">
            <GradientHero>
                <template v-slot:subtitle>
                    Alles over kouw mentale ontwikkeling op één plek
                </template>
                <template v-slot:title>
                    Kies je lidmaatschap
                </template>
            </GradientHero>

            <div class="flex flex-col bg-blue-700 pt-16 pb-8 px-8 rounded-bl-xl rounded-br-xl">
                <p class="text-header_l text-gray-100 font-bold text-center mb-16">
                    Word lid en start<br> met de <span class="gradient-text">me-learning</span>
                </p>

                <div class="flex gradient-background rounded-xl p-3 gap-x-4">
                    <div class="flex flex-col bg-gray-100 rounded-xl w-full gap-y-3 p-3 shadow-mh_box_shadow">
                        <p class="text-header_s">Maandelijks lidmaatschap</p>
                        <p class="text-header_m leading-4">€19,99<span class="text-base">/mnd*</span></p>
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
                        <p class="text-base font-medium pt-2 border border-0 border-t border-blue-700">Aanvullend op het platform te bestellen</p>
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
                        <a
                            :href="'/checkout/price_1QZ3biDgwQ2kaUkEaEyAxWbH'"
                            class="mt-4"
                            :class="{'pointer-events-none': ButtonOneClicked, 'pointer-events-none': DisableButtonOne}"
                        >
                            <button
                                class="button-primary w-full"
                                :class="{'button-primary-loading spinner': ButtonOneClicked, 'button-primary-disabled': DisableButtonOne}"
                                @click="handleClickButtonOne">
                                Naar afrekenen
                            </button>
                        </a >
                        <p class="text-base italic text-center">* lidmaatschap is opzegbaar wanneer jij wil</p>
                    </div>
                    <div class="flex flex-col bg-gray-100 rounded-xl w-full gap-y-3 p-3 shadow-mh_box_shadow">
                        <p class="text-header_s">Kwartaal lidmaatschap</p>
                        <p class="text-header_m leading-4">€49,99<span class="text-base">/elke 3 maanden*</span></p>
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
                        <p class="text-base font-medium pt-2 border border-0 border-t border-blue-700">Aanvullend op het platform te bestellen</p>
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
                        <a
                            :href="'/checkout/price_1QZ3bEDgwQ2kaUkE5yC5gqO0'"
                            class="mt-4"
                            :class="{'pointer-events-none': ButtonTwoClicked, 'pointer-events-none': DisableButtonTwo}"
                        >
                            <button
                                class="button-primary w-full"
                                :class="{'button-primary-loading spinner': ButtonTwoClicked, 'button-primary-disabled': DisableButtonTwo}"
                                @click="handleClickButtonTwo">
                                Naar afrekenen
                            </button>
                        </a >
                        <p class="text-base italic text-center">* lidmaatschap is opzegbaar wanneer jij wil</p>
                    </div>
                </div>
                <div class="flex text-base text-white items-center mt-8 justify-center">
                    Wanneer je afrekent, ga je akkoord met onze&nbsp
                    <div class="flex group items-center">
                        <div>
                            <Link
                                href="/voorwaarden"
                                target="_blank"
                                class="text-white font-medium link-underline-green"
                            >
                                voorwaarden
                            </Link>
                        </div>
                        <div>
                            <svg
                                class="group-hover:translate-x-[2px] mh-transition ml-1"
                                width="16"
                                height="16"
                                viewBox="0 0 24 24"
                                fill="none"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke="white"
                                    stroke-width="1.5"
                                />
                            </svg>
                        </div>
                    </div>
                    , en ons&nbsp
                    <div class="flex group items-center">
                        <div>
                            <Link
                                href="/privacybeleid"
                                target="_blank"
                                class="text-white font-medium link-underline-green"
                            >
                                privacybeleid
                            </Link>
                        </div>
                        <div>
                            <svg
                                class="group-hover:translate-x-[2px] mh-transition ml-1"
                                width="16"
                                height="16"
                                viewBox="0 0 24 24"
                                fill="none"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke="white"
                                    stroke-width="1.5"
                                />
                            </svg>
                        </div>
                    </div>
                    .
                </div>
            </div>
        </div>

    </Layout>
</template>

<style scoped>

</style>
