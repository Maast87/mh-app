import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useAchievementStore = defineStore('achievement', () => {
    const showModal = ref(false);
    const currentAchievement = ref(null);

    function setCurrentAchievement(achievement) {
        currentAchievement.value = achievement;
        showModal.value = true;
    }

    function clearCurrentAchievement() {
        currentAchievement.value = null;
        showModal.value = false;
    }

    return {
        showModal,
        currentAchievement,
        setCurrentAchievement,
        clearCurrentAchievement,
    };
}); 