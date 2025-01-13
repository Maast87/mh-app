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
        disableAfterClick: {
            type: Boolean,
            default: false,
        },
    });

    const DisableButton = ref(props.disabled);

    watch(() => props.disabled, (newValue) => {
        DisableButton.value = newValue;
    });

    const handleClickButton = (event) => {
        if (DisableButton.value) {
            event.preventDefault();
            return;
        }

        if (props.disableAfterClick) {
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
            class="button-two w-full"
            :class="{
                'button-two-loading spinner': DisableButton && allowSpinner,
                'button-two-loading': DisableButton
            }"
            @click="handleClickButton"
        >
            {{ title }}
        </button>
    </Link>
    <button
        v-else
        class="button-two w-full"
        :class="{
            'button-two-loading spinner': DisableButton && allowSpinner,
            'button-two-loading': DisableButton
        }"
        @click="handleClickButton"
    >
        {{ title }}
    </button>
</template>
