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
    <textarea
        class="rounded-lg bg-gray_100_blue_900 border-blue_700_gray_100 focus:ring-blue_700_gray_100 text-blue_700_gray_100 input-placeholder w-full"
        v-model="model"
        ref="input"
    />
</template>
