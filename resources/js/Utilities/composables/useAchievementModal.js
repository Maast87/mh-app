import { reactive, readonly } from 'vue';

const globalState = reactive({
    show: false,
    achievement: null,
    achievementTypeSlug: null,
});

export function useAchievementModal() {
    const resetModal = () => {
        globalState.show = false;
        globalState.achievement = null;
        globalState.achievementTypeSlug = null;
    };

    return {
        state: readonly(globalState),
        showAchievement: (achievement, typeSlug) => {
            globalState.achievement = achievement;
            globalState.achievementTypeSlug = typeSlug;
            globalState.show = true;
        },
        close: () => {
            resetModal();
        },
    };
} 