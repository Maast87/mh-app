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
    <div>
        <Link
            v-if="href"
            :href="href"
            :class="{'pointer-events-none': DisableButton}"
        >
            <button
                class="button-three w-full"
                :class="{
                    'button-three-loading spinner': DisableButton && allowSpinner,
                    'button-three-disabled': DisableButton
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
                'button-three-disabled': DisableButton
            }"
            @click="handleClickButton"
        >
            {{ title }}
        </button>
    </div>
</template>
