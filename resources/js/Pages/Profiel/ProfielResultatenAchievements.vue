<script setup>
    import {Head} from "@inertiajs/vue3";
    import ProfileLayout from "@/Pages/Shared/ProfileLayout.vue";
    import Layout from "@/Pages/Shared/Layout.vue";
    import {provide, computed} from "vue";
    import GradientElement from "@/Components/PageLayoutElements/GradientElement.vue";
    import GradientWhiteElement from "@/Components/PageLayoutElements/GradientWhiteElement.vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "profiel", href: "/profiel" },
        { label: "resultaten", href: "/profiel/resultaten" },
        { label: "achievements" }
    ];
    provide('breadcrumbs', breadcrumbs);

    const props = defineProps({
        requestedTagname: String,
        achievementTypes: Array,
        requestedUser: Object,
    });

    const getAchievementImagePath = (type, level) => {
        return `/images/achievements/mental-hygiene-achievement-${type.slug}-level-${level}.png`;
    };
</script>

<template>
    <Layout>
        <Head title="Profiel resultaten achievements" />

        <div class="flex flex-col w-full">
            <ProfileLayout :requestedTagname="requestedTagname" />

            <GradientElement class="flex flex-col w-full gap-y-4">
                <GradientWhiteElement v-for="type in achievementTypes" :key="type.id" class="flex flex-col w-full !p-0">
                    <div class="bg-blue-700 rounded-xl justify-center items-center py-2">
                        <h3 class="text-header_s font-semibold text-gray-100 text-center">{{ type.name }}</h3>
                    </div>

                    <div class="flex justify-center">
                        <div class="flex flex-col p-3 border border-gray-300 rounded-lg w-2/5 justify-center items-center">
                            <p class="text-base font-medium text-blue_700_gray_100">
                                Toelichting:
                            </p>
                            <p class="text-base text-blue_700_gray_100">
                                {{ type.description }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
                        <div v-for="achievement in type.achievements" :key="achievement.id"
                            class="border rounded-lg"
                            :class="{
                                'opacity-100': achievement.is_earned,
                                'opacity-50': !achievement.is_earned,
                            }"
                        >
                            <div class="flex flex-col items-center justify-center border border-blue_700_gray_100 rounded-lg px-2 pb-2">
                                <div class="flex justify-center items-center bg-blue_700_gray_100 rounded-bl-lg rounded-br-lg w-3/4 py-1 mb-4">
                                    <h4 class="text-base font-semibold text-gray_100_blue_900 text-center">{{ achievement.name }}</h4>
                                </div>
                                <div class="w-1/2 h-1/2 bg-gray-300 flex items-center justify-center">
                                    <img 
                                        :src="getAchievementImagePath(type, achievement.tier_name.split(' ')[1])" 
                                        :alt="achievement.name"
                                    >
                                </div>
                                <div class="flex flex-col items-center justify-center text-blue_700_gray_100 mt-3">
                                    <p class="text-base font-medium mb-1">{{ achievement.tier_name }} - {{ type.progress.points }}/{{ achievement.required_points }} punten</p>
                                    
                                    <div v-if="achievement.is_earned" class="flex items-center gap-x-1.5 rounded-full bg-green-100 py-1 pl-1 pr-3 mt-1 mb-1">
                                        <div class="w-6 h-6">
                                            <svg id="uuid-b8f6a5c4-e2ad-4025-8699-8e391ad2ceec" data-name="Content" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                                                <circle cx="61.5" cy="62.5" r="45.5" style="fill: none; stroke: #fff; stroke-miterlimit: 10; stroke-width: 6px;"/>
                                                <g>
                                                    <line x1="56.62" y1="84.65" x2="40.98" y2="65.28" style="fill: none; stroke: #fff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 6px;"/>
                                                    <line x1="86.57" y1="43.08" x2="56.62" y2="84.65" style="fill: none; stroke: #fff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 6px;"/>
                                                </g>
                                            </svg>
                                        </div>
                                        <p class="text-center text-gray-100 font-medium">Behaald op {{ new Date(achievement.earned_at).toLocaleDateString() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </GradientWhiteElement>
            </GradientElement>
        </div>
    </Layout>
</template>