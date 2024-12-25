<script setup>
    import { computed } from 'vue';

    const emit = defineEmits(['update:checked']);

    const props = defineProps({
        checked: {
            type: [Array, Boolean],
            required: true,
        },
        value: {
            default: null,
        },
    });

    const proxyChecked = computed({
        get() {
            return props.checked;
        },

        set(val) {
            emit('update:checked', val);
        },
    });
</script>

<template>
    <input
        type="checkbox"
        :value="value"
        v-model="proxyChecked"
        class="rounded bg-gray_100_blue_900 border-blue_700_gray_100 text-blue-700 focus:ring-blue-700"
    />
</template>
