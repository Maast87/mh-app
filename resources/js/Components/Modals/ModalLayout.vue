<script setup>
    import { computed, onMounted, onUnmounted, ref, watch } from 'vue';
    import Confetti from '@/Components/Confetti.vue';

    const props = defineProps({
        show: {
            type: Boolean,
            default: false,
        },
        maxWidth: {
            type: String,
            default: '2xl',
        },
        closeable: {
            type: Boolean,
            default: true,
        },
        showConfetti: {
            type: Boolean,
            default: false,
        }
    });

    const emit = defineEmits(['close']);
    const dialog = ref();
    const showSlot = ref(props.show);
    const confettiRef = ref(null);

    const showModal = () => {
        console.log('[ModalLayout] Showing modal, dialog element:', dialog.value);
        if (dialog.value) {
            document.body.style.overflow = 'hidden';
            showSlot.value = true;
            dialog.value.showModal();
            
            if (props.showConfetti && confettiRef.value) {
                confettiRef.value.startAnimation();
            }
        }
    };

    const hideModal = () => {
        console.log('[ModalLayout] Hiding modal');
        document.body.style.overflow = '';
        if (dialog.value) {
            dialog.value.close();
            showSlot.value = false;
        }
    };

    // Watch for show prop changes
    watch(() => props.show, (value) => {
        console.log('[ModalLayout] Show prop changed:', value);
        if (value) {
            showModal();
        } else {
            hideModal();
        }
    });

    // Show modal on mount if show prop is true
    onMounted(() => {
        console.log('[ModalLayout] Component mounted, show prop:', props.show);
        if (props.show) {
            showModal();
        }
    });

    const close = () => {
        if (props.closeable) {
            emit('close');
        }
    };

    const closeOnEscape = (e) => {
        if (e.key === 'Escape') {
            e.preventDefault();
            if (props.show) {
                close();
            }
        }
    };

    onMounted(() => document.addEventListener('keydown', closeOnEscape));

    onUnmounted(() => {
        document.removeEventListener('keydown', closeOnEscape);
        document.body.style.overflow = '';
    });

    const maxWidthClass = computed(() => {
        return {
            sm: 'sm:max-w-sm',
            md: 'sm:max-w-md',
            lg: 'sm:max-w-lg',
            xl: 'sm:max-w-xl',
            '2xl': 'sm:max-w-2xl',
        }[props.maxWidth];
    });
</script>

<template>
    <dialog
        class="z-50 m-0 min-h-full min-w-full overflow-y-auto bg-transparent backdrop:bg-black/50"
        ref="dialog"
    >
        <Confetti 
            v-if="showConfetti"
            ref="confettiRef" 
            class="!fixed"
        />
        
        <div
            class="fixed inset-0 z-50 flex items-center justify-center px-4 py-6 sm:px-0"
            scroll-region
        >
            <Transition
                enter-active-class="ease-out duration-300"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="ease-in duration-200"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div
                    v-show="show"
                    class="fixed inset-0 transform transition-all"
                    @click="close"
                >
                    <div class="absolute inset-0 bg-black opacity-50" />
                </div>
            </Transition>

            <Transition
                enter-active-class="ease-out duration-300"
                enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                leave-active-class="ease-in duration-200"
                leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
                <div
                    v-show="show"
                    class="transform overflow-hidden rounded-lg bg-white shadow-xl transition-all sm:w-full"
                    :class="maxWidthClass"
                >
                    <div class="flex flex-col px-4 pb-4 pt-2 gap-y-4">
                        <slot name="title" />
                        <slot name="content" />
                        <slot name="footer" />
                    </div>
                </div>
            </Transition>
        </div>
    </dialog>
</template>

<style scoped>
.confetti {
    pointer-events: none;
}
</style>
