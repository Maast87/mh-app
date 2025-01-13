<script setup>
    import Layout from "../Shared/Layout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import {provide} from "vue";
    import ProfileLayout from "@/Pages/Shared/ProfileLayout.vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "profiel", href: "/profiel" },
        { label: "resultaten" }
    ];
    provide('breadcrumbs', breadcrumbs);

    const props = defineProps({
        requestedTagname: String,
        scores: Array,
    });

    const formatDate = (dateString) => {
        return new Date(dateString).toLocaleString('nl-NL', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    };

</script>

<template>
    <Layout>
        <Head title="Profiel resultaten" />

        <div class="flex flex-col w-full">
            <ProfileLayout :requestedTagname="requestedTagname" />
            <div class="flex w-full gap-x-4 p-6 bg-gray-100 rounded-xl">
                <div class="w-full">
                    <h2 class="text-xl font-semibold mb-4">Check Resultaten</h2>
                    <div v-if="scores && scores.length > 0" class="space-y-4">
                        <div v-for="score in scores" :key="score.id" class="p-4 bg-white rounded-lg shadow">
                            <p class="text-lg">Score: {{ score.score }}</p>
                            <p class="text-sm text-gray-600">Datum: {{ formatDate(score.created_at) }}</p>
                        </div>
                    </div>
                    <p v-else class="text-gray-600">Nog geen resultaten beschikbaar.</p>
                </div>
            </div>
        </div>
    </Layout>
</template>

<style scoped>

</style>
