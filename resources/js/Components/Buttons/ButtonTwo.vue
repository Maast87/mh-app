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

        if (! window.location.href === props.href) {
            DisableButton.value = true;
        }
    };
</script>

<template>

    <Link
        :href="href"
        :class="{'pointer-events-none': DisableButton}"
    >
        <button
            class="button-two w-full"
            :class="{
                    'button-two-loading spinner': DisableButton && allowSpinner,
                    'button-two-disabled': DisableButton
                }"
            @click="handleClickButton"
        >
            Link to {{ title }}
        </button>
    </Link>
<!--    <template v-if="href">-->
<!--        -->
<!--    </template>-->
<!--    <template v-if="! href">-->
<!--        <button-->
<!--            class="button-two w-full mt-4"-->
<!--            :class="{-->
<!--                'button-two-loading spinner': DisableButton && allowSpinner,-->
<!--                'button-two-disabled': DisableButton-->
<!--            }"-->
<!--            @click="handleClickButton"-->
<!--        >-->
<!--            Button to {{ title }}-->
<!--        </button>-->
<!--    </template>-->
</template>
