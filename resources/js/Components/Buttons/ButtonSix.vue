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
            class="button-six w-full group"
            :class="{
                'button-six-loading spinner': DisableButton && allowSpinner,
                'button-six-loading': DisableButton
            }"
            @click="handleClickButton"
        >
            <p class="group-hover:drop-shadow-[0_2px_1px_rgba(0,0,0,0.4)] group-hover:text-gray-100">
                {{ title }}
            </p>
        </button>
    </Link>
    <button
        v-else
        class="button-six w-full group"
        :class="{
            'button-six-loading spinner': DisableButton && allowSpinner,
            'button-six-loading': DisableButton
        }"
        @click="handleClickButton"
    >
        <p class="group-hover:drop-shadow-[0_2px_1px_rgba(0,0,0,0.4)] group-hover:text-gray-100">
            {{ title }}
        </p>
    </button>
</template>
