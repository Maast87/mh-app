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
                class="button-six w-full group"
                :class="{
                    'button-six-loading spinner': DisableButton && allowSpinner,
                    'button-six-disabled': DisableButton
                }"
                @click="handleClickButton"
            >
                <p class="group-hover:text-white group-hover:drop-shadow-[0_2px_1px_rgba(0,0,0,0.4)]">{{ title }}</p>
            </button>
        </Link>

        <button
            v-else
            class="button-six w-full"
            :class="{
                'button-six-loading spinner': DisableButton && allowSpinner,
                'button-six-disabled': DisableButton
            }"
            @click="handleClickButton"
        >
            {{ title }}
        </button>
    </div>
</template>
