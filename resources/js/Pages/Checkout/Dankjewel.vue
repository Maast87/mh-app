<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import GradientHero from "../../Components/PageLayoutElements/GradientHero.vue";
    import DarkblueElement from "@/Components/PageLayoutElements/DarkblueElement.vue";
    import {Head} from "@inertiajs/vue3";
    import {provide} from "vue";
    import ButtonFifth from "@/Components/Buttons/ButtonFifth.vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "dankjewel voor je aankoop" },
    ];
    provide('breadcrumbs', breadcrumbs);
</script>

<template>
    <Layout>
        <Head title="Home" />

        <div class="flex flex-col w-full">
            <GradientHero>
                <template v-slot:subtitle>
                    Dankjewel voor je aankoop!
                </template>
                <template v-slot:title>
                    Welkom bij de club
                </template>
            </GradientHero>

            <DarkblueElement class="pb-8">
                <h2 class="text-header_l text-gray-100 font-bold text-center">
                    Bekijk de video voor<br>de <span class="gradient-text">volgende</span> stap
                </h2>
                <div class="w-full">
                    <div style="position:relative; padding-top:56.25%;">
                        <iframe
                            src="https://iframe.mediadelivery.net/embed/360263/5c4ae94a-3198-4300-a2e3-86a5dceead21?autoplay=true&loop=false&muted=false&preload=true&responsive=true"
                            loading="eager"
                            style="border: 0; position: absolute; top: 0; height: 100%; width: 100%; border-radius: 0.75rem"
                            allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;"
                            allowfullscreen="true"
                        ></iframe>
                    </div>
                </div>

                <div class="flex justify-center">
                    <ButtonFifth title="Naar de me-learning" href="me-learning" />
                </div>
            </DarkblueElement>
        </div>
    </Layout>
</template>

<style scoped>

</style>
