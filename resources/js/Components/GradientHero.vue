<script setup>

</script>

<template>
    <div class="flex flex-col items-center gradient-background rounded-tl-xl rounded-tr-xl w-full px-10 py-20">
        <p
            class="text-gray-100 font-medium text-base drop-shadow-[0_2px_1px_rgba(0,0,0,0.4)]"
            v-if="$slots.subtitle"
        >
            <slot name="subtitle"></slot>
        </p>
        <h1
            class="text-gray-100 font-bold text-header_xl drop-shadow-[0_3px_2px_rgba(0,0,0,0.45)] text-center"
            v-if="$slots.title"
        >
            <slot name="title"></slot>
        </h1>
    </div>
</template>

<style scoped>

</style>
