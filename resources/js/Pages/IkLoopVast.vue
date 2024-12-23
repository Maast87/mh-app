<script setup>
    import Layout from "../Pages/Shared/Layout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import DarkModeToggle from "@/Components/DarkModeToggle.vue";
<<<<<<< Updated upstream
=======
    import {ref} from "vue";
>>>>>>> Stashed changes

    defineOptions({
        layout: Layout
    });

    const isClicked = ref(false);

    const handleClick = () => {
        isClicked.value = true;
    };
</script>

<template>
    <Head tag="Ik loop vast" />
    <p>Pagina Ik loop vast</p>

    <DarkModeToggle />
<<<<<<< Updated upstream
=======

    <a class="mt-4">
        <button
            class="button-primary w-full"
            :class="{'button-primary-loading spinner': isClicked}"
            @click="handleClick">
            Click
        </button>
    </a >
>>>>>>> Stashed changes
</template>

<style scoped>

</style>
