import { defineStore } from 'pinia';
import { usePage } from '@inertiajs/vue3';
import { watch, onMounted } from 'vue';
import { useAchievementModal } from '@/Utilities/composables/useAchievementModal';

export const useAchievementStore = defineStore('achievement', () => {
    const { showAchievement } = useAchievementModal();
    

    // Watch for achievement_unlocked in page props
    watch(
        () => usePage().props.achievement_unlocked,
        (achievement) => {
            if (achievement) {
                const typeSlug = achievement.achievement_type_id === 1 ? 'log-in-achievements' : 'zelfcheck-achievements';
                showAchievement(achievement, typeSlug);
            }
        },
        { immediate: true }
    );

    return {};
}); 