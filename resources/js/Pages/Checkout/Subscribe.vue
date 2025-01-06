<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import { Head, Link } from "@inertiajs/vue3";
    import GradientHero from "@/Components/PageLayoutElements/GradientHero.vue";
    import {provide} from "vue";
    import DarkblueElement from "@/Components/PageLayoutElements/DarkblueElement.vue";
    import PricingCards from "@/Pages/Shared/PricingCards.vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "word lid" }
    ];
    provide('breadcrumbs', breadcrumbs);

    const props = defineProps({
        pricing: Object
    });

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

            <DarkblueElement>
                <div class="flex flex-col">
                    <p class="text-header_l text-gray-100 font-bold text-center mb-16">
                        Word lid en start<br> met de <span class="gradient-text">me-learning</span>
                    </p>

                    <PricingCards :pricing="pricing" />

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
            </DarkblueElement>
        </div>

    </Layout>
</template>

<style scoped>

</style>
