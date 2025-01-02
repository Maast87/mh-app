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
        class="button-six w-full"
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
