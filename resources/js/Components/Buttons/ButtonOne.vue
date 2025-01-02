<script setup>
    import { defineProps, watch, ref } from "vue";
    import { Link } from "@inertiajs/vue3";

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
        disabled: {
            type: Boolean,
            default: false,
        },
    });

    const DisableButton = ref(props.disabled);

    // Watch for prop changes and update the internal state
    watch(() => props.disabled, (newValue) => {
        DisableButton.value = newValue;
    });

    // Handle button click action, respecting the disabled state
    const handleClickButton = (event) => {
        if (DisableButton.value) {
            // Prevent any action if the button is disabled
            event.preventDefault();
            return;
        }

        // Otherwise, proceed with the action
        DisableButton.value = true;
    };
</script>

<template>
    <Link
        v-if="href"
        :href="href"
        :class="{'pointer-events-none': DisableButton}"
    >
        <button
            class="button-one w-full"
            :class="{
                'button-one-loading spinner': DisableButton && allowSpinner,
                'button-one-loading': DisableButton
            }"
            @click="handleClickButton"
        >
            {{ title }}
        </button>
    </Link>
    <button
        v-else
        class="button-one w-full"
        :class="{
            'button-one-loading spinner': DisableButton && allowSpinner,
            'button-one-loading': DisableButton
        }"
        @click="handleClickButton"
    >
        {{ title }}
    </button>
</template>
