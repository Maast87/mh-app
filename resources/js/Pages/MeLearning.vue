<script setup>
    import Layout from "../Pages/Shared/Layout.vue";
    import { Head } from "@inertiajs/vue3";
    import {provide} from "vue";
    import CheckInterface from "@/Components/CheckInterface.vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "dashboard", href: "/dashboard" },
        { label: "homepage" }
    ];
    provide('breadcrumbs', breadcrumbs);


</script>

<template>
    <Layout>
        <Head tag="Me-learning"/>

        <CheckInterface
            store="dummyCheckQuestions"
            :lowThreshold="{ max: 60 }"
            :midThreshold="{ min: 61, max: 129 }"
            :highThreshold="{ min: 130 }"
        >
            <template v-slot:message-low-threshold>
                <p>
                    Low threshold
                </p>
            </template>
            <template v-slot:message-mid-threshold>
                <p>
                    Mid threshold
                </p>
            </template>
            <template v-slot:message-high-threshold>
                <p>
                    High threshold
                </p>
            </template>
        </CheckInterface>

    </Layout>
</template>
