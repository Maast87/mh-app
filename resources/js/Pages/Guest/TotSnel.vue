<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import {provide} from "vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "je bent uitgelogd" },
    ];
    provide('breadcrumbs', breadcrumbs);
</script>

<template>
    <Layout>
        <Head title="Tot snel" />

        <div class="flex flex-col justify-center items-center w-full px-10 pt-20 pb-10 gap-y-4">
            <h1 class="text-header_xl text-blue_700_gray_100 text-center">Je bent <span class="gradient-text">uitgelogd</span></h1>
            <p class="text-base text-blue_700_gray_100">Graag tot snel.</p>

            <div class="mt-2">
                <Link href="/">
                    <button class="button-primary">Naar home</button>
                </Link>
            </div>

            <div class="pt-8">
                <img
                    src="../../../images/mental-hygiene-vormgeving-brian-tot-snel.png"
                    class="rounded-xl"
                >
            </div>
        </div>
    </Layout>
</template>
