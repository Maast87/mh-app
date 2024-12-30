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

    const handleClickButton = (event) => {
        if (props.href) {
            event.preventDefault();
            window.location.href = props.href;
        }

        DisableButton.value = true;
    };
</script>

<template>
    <template v-if="href">
        <Link
            :href="href"
            :class="{'pointer-events-none': DisableButton}"
        >
            <button
                class="button-one w-full"
                :class="{
                    'button-one-loading spinner': DisableButton && allowSpinner,
                    'button-one-disabled': DisableButton
                }"
                @click="handleClickButton"
            >
                Link to {{ title }}
            </button>
        </Link>
    </template>

    <template v-if="! href">
        <button
            class="button-one w-full"
            :class="{
                'button-one-loading spinner': DisableButton && allowSpinner,
                'button-one-disabled': DisableButton
            }"
            @click="handleClickButton"
        >
            Button to {{ title }}
        </button>
    </template>
</template>
