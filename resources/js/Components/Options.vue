<script setup>
import { ref, onMounted, defineProps } from 'vue';

defineProps({
    options: {
        type: Array,
        required: true,
    },
});

const model = defineModel({
    type: String,
    required: true,
});

const select = ref(null);

onMounted(() => {
    if (select.value.hasAttribute('autofocus')) {
        select.value.focus();
    }
});

defineExpose({ focus: () => select.value.focus() });
</script>

<template>
    <select
        class="rounded-lg bg-gray_100_blue_900 border-blue_700_gray_100 focus:ring-blue_700_gray_100 text-blue_700_gray_100 input-placeholder"
        v-model="model"
        ref="select"
    >
        <option value="" disabled selected hidden>Kies een optie</option>
        <option v-for="(option, index) in options" :key="index" :value="option.value">
            {{ option.label }}
        </option>
    </select>
</template>
