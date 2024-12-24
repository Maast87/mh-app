<script setup>
    import { onMounted, ref } from 'vue';

    const model = defineModel({
        type: String,
        required: true,
    });

    const input = ref(null);

    onMounted(() => {
        if (input.value.hasAttribute('autofocus')) {
            input.value.focus();
        }
    });

    defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="rounded-lg border-blue-700 focus:ring-blue-700 input-placeholder"
        v-model="model"
        ref="input"
    />
</template>
