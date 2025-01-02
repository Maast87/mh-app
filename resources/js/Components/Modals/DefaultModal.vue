<script setup>
    import ModalLayout from "@/Components/Modals/ModalLayout.vue";
    import ButtonOne from "@/Components/Buttons/ButtonOne.vue";

    const props = defineProps({
        show: {
            type: Boolean,
            default: false,
        },
    });

    const emit = defineEmits(['close']);
</script>

<template>
    <ModalLayout :show="show" @close="emit('close')">
        <template #title>
            <div class="flex border border-0 border-b border-blue_700_gray_100 pb-2 gap-x-4">
                <div class="flex">
                    <svg
                        width="56"
                        height="56"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 128 128"
                    >
                        <circle cx="61.5" cy="62.5" r="45.5" style="fill: none; stroke: var(--mh-green-100); stroke-miterlimit: 10; stroke-width: 4.5px;" />
                        <g>
                            <line x1="56.62" y1="84.65" x2="40.98" y2="65.28" style="fill: none; stroke: var(--mh-green-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px;" />
                            <line x1="86.57" y1="43.08" x2="56.62" y2="84.65" style="fill: none; stroke: var(--mh-green-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px;" />
                        </g>
                    </svg>
                </div>
                <div class="flex items-center">
                    <p class="text-header_s text-blue_700_gray_100">
                        <slot name="title" />
                    </p>
                </div>
            </div>
        </template>
        <template #content>
            <div>
                <slot name="content" />
            </div>
        </template>
        <template #footer>
            <div class="flex gap-x-4">
                <ButtonOne @click="emit('close')" title="Sluiten" />
            </div>
        </template>
    </ModalLayout>
</template>
