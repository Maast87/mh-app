<script setup>
    import { Link } from "@inertiajs/vue3";
    import {inject} from "vue";
    import ButtonFour from "@/Components/Buttons/ButtonFour.vue";

    const breadcrumbs = inject("breadcrumbs")

    function goBack(event) {
        event.preventDefault();
        window.history.back();
    }
</script>

<template>
    <div>
        <ButtonFour id="previous" title="Vorige pagina" @click="goBack" />
    </div>
    <div class="flex items-center pl-3 border-0 border-l border-blue_700_gray_100">
        <p>
            <template v-for="(item, index) in breadcrumbs" :key="index">
                <Link
                    v-if="item.href"
                    :href="item.href"
                    class="link-underline-green"
                >
                    {{ item.label }}
                </Link>
                <span v-else class="font-semibold text-blue_700_gray_100">
                    {{ item.label }}
                </span>
                <span
                    v-if="index < breadcrumbs.length - 1"
                    class="text-blue_700_gray_100 mx-1"
                >
                    -
                </span>
            </template>
        </p>
    </div>
</template>

<style scoped>

</style>
