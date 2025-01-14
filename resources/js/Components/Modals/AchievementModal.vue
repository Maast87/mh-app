<script setup>
import ModalLayout from '@/Components/Modals/ModalLayout.vue';
import { useAchievementStore } from '@/stores/achievement';
import { onMounted, watch } from 'vue';

const store = useAchievementStore();

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(['close']);

const close = () => {
    emit('close');
    store.clearCurrentAchievement();
};

// Auto-close after 5 seconds
watch(() => props.show, (newValue) => {
    if (newValue) {
        setTimeout(() => {
            close();
        }, 5000);
    }
});
</script>

<template>
    <ModalLayout
        :show="show"
        :closeable="true"
        max-width="md"
        @close="close"
    >
        <template #title>
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-medium">Achievement Unlocked! 🎉</h2>
                <button
                    class="rounded-full p-1 hover:bg-gray-100"
                    @click="close"
                >
                    <svg
                        class="h-5 w-5 text-gray-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
        </template>

        <template #content>
            <div v-if="store.currentAchievement" class="flex flex-col items-center gap-4 py-4">
                <div 
                    class="flex h-20 w-20 items-center justify-center rounded-full bg-blue-100"
                    :class="{
                        'bg-bronze-100': store.currentAchievement.tier_name === 'Bronze',
                        'bg-silver-100': store.currentAchievement.tier_name === 'Silver',
                        'bg-gold-100': store.currentAchievement.tier_name === 'Gold',
                    }"
                >
                    <img
                        v-if="store.currentAchievement.icon_path"
                        :src="store.currentAchievement.icon_path"
                        :alt="store.currentAchievement.name"
                        class="h-12 w-12"
                    />
                    <svg
                        v-else
                        class="h-12 w-12 text-blue-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"
                        />
                    </svg>
                </div>

                <div class="text-center">
                    <h3 class="text-xl font-semibold text-gray-900">
                        {{ store.currentAchievement.name }}
                    </h3>
                    <p class="mt-2 text-sm text-gray-600">
                        {{ store.currentAchievement.description }}
                    </p>
                    <p class="mt-1 text-xs font-medium text-gray-500">
                        {{ store.currentAchievement.tier_name }} Tier
                    </p>
                </div>
            </div>
        </template>

        <template #footer>
            <div class="flex justify-end">
                <button
                    class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                    @click="close"
                >
                    Continue
                </button>
            </div>
        </template>
    </ModalLayout>
</template> 