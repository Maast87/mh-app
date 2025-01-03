<script setup>
    import { computed } from 'vue';

    const model = defineModel('checked');

    const props = defineProps({
        value: {
            default: null,
        },
    });

</script>

<template>
    <input
        v-model="model"
        type="checkbox"
        :value="value"
        class="rounded bg-gray_100_blue_900 border-blue_700_gray_100 text-blue-700 focus:ring-blue-700"
    />
</template>
