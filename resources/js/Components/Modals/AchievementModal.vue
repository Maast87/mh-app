<script setup>
    import { useAchievementModal } from '@/Utilities/composables/useAchievementModal';
    import ModalLayout from '@/Components/Modals/ModalLayout.vue';
    import ButtonFour from '@/Components/Buttons/ButtonFour.vue';
    import ButtonOne from '@/Components/Buttons/ButtonOne.vue';
    import { router, usePage } from '@inertiajs/vue3';
    const { state, close } = useAchievementModal();

    const getAchievementImagePath = (achievement) => {
        if (!achievement) return '';
        const level = achievement.tier_name.split(' ')[1];
        return `/images/achievements/mental-hygiene-achievement-${state.achievementTypeSlug}-level-${level}.png`;
    };

    const handleClose = () => {
        close();
    };

    const handleViewAchievements = () => {
        handleClose();
        router.visit(route('profiel.resultaten.achievements', { tagname: auth.user.tag_name }));
    };

    const auth = usePage().props.auth;
</script>

<template>
    <ModalLayout 
        :show="state.show" 
        :show-confetti="true"
        @close="handleClose"
        maxWidth="md"
    >
        <template #title>
            <div class="flex border border-0 border-b border-blue_700_gray_100 pb-2 gap-x-4">
                <div class="flex w-full items-center justify-center">
                    <p class="text-header_s text-blue_700_gray_100 text-center">
                        Achievement vrijgespeeld! 🎉
                    </p>
                </div>
            </div>
        </template>

        <template #content>
            <div v-if="state.achievement" class="flex flex-col items-center gap-4 py-2">
                <div class="w-1/2 h-1/2 bg-gray-300 flex items-center justify-center">
                    <img 
                        :src="getAchievementImagePath(state.achievement)" 
                        :alt="state.achievement.name"
                    >
                </div>
                <div class="text-center">
                    <h3 class="text-header_s text-blue_700_gray_100">
                        {{ state.achievement.name }}
                    </h3>
                    <p class="mt-1 text-base font-medium text-blue_700_gray_100">
                        {{ state.achievement.tier_name }}
                    </p>
                    <p class="mt-1 text-base text-blue_700_gray_100">
                        {{ state.achievement.description }}
                    </p>
                </div>
            </div>
        </template>

        <template #footer>
            <div v-if="state.achievement" class="flex gap-x-4">
                <ButtonOne 
                    @click="handleViewAchievements" 
                    title="Bekijk mijn achievements" 
                    class="w-full"
                >
                    Ga naar achievements
                </ButtonOne>
                <ButtonFour @click="handleClose" title="Sluiten" class="flex flex-1" />
            </div>
            <div v-else class="flex">
                <ButtonFour @click="handleClose" title="Sluiten" class="flex flex-1" />
            </div>
        </template>
    </ModalLayout>
</template>