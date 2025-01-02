<script setup>
    import { Link } from "@inertiajs/vue3";
    import { ref } from "vue";

    const props = defineProps({
        title: String,
        href: {
            type: String,
            default: null,
        },
        allowSpinner: {
            type: Boolean,
            default: false,
        },
    });

    const DisableButton = ref(false);

    const handleClickButton = () => {
        if (!DisableButton.value) {
            DisableButton.value = true;
        }
    };
</script>

<template>
    <Link
        v-if="href"
        :href="href"
        :class="{'pointer-events-none': DisableButton}"
    >
        <button
            class="button-three w-full"
            :class="{
                'button-three-loading spinner': DisableButton && allowSpinner,
                'button-three-loading': DisableButton
            }"
            @click="handleClickButton"
        >
            {{ title }}
        </button>
    </Link>
    <button
        v-else
        class="button-three w-full"
        :class="{
            'button-three-loading spinner': DisableButton && allowSpinner,
            'button-three-loading': DisableButton
        }"
        @click="handleClickButton"
    >
        {{ title }}
    </button>
</template>
