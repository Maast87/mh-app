<script setup>
    import Layout from "../Shared/Layout.vue";
    import {Head} from "@inertiajs/vue3";
    import {provide, onMounted} from "vue";
    import ProfileLayout from "@/Pages/Shared/ProfileLayout.vue";
    import { Chart } from 'chart.js/auto';
    import GradientElement from "@/Components/PageLayoutElements/GradientElement.vue";
    import GradientWhiteElement from "@/Components/PageLayoutElements/GradientWhiteElement.vue";

    Chart.defaults.font.family = "'Montserrat', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif";
    Chart.defaults.font.size = 14;
    Chart.defaults.font.weight = '400';
    Chart.defaults.color = '#0E122C';

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "profiel", href: "/profiel" },
        { label: "resultaten" }
    ];
    provide('breadcrumbs', breadcrumbs);

    const props = defineProps({
        requestedTagname: String,
    });
</script>

<template>
    <Layout>
        <Head title="Profiel resultaten" />

        <div class="flex flex-col w-full">
            <ProfileLayout :requestedTagname="requestedTagname" />
            
            <div class="flex w-full gap-x-4 bg-gray-100 rounded-xl mb-6">
                <p>Content goes here</p>
            </div>
        </div>
    </Layout>
</template>