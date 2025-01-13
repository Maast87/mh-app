<script setup>
    import Layout from "../Shared/Layout.vue";
    import { Head } from "@inertiajs/vue3";
    import {provide} from "vue";
    import CheckInterface from "@/Components/CheckInterface.vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "me-learning" }
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
            :checkId="1"
        >
            <template v-slot:message-low-threshold>
                <p>
                    Hier komt de toelichting voor wanneer iemand een score heeft behaald in de onderste van de drie categoriën
                </p>
            </template>
            <template v-slot:message-mid-threshold>
                <p>
                    Hier komt de toelichting voor wanneer iemand een score heeft behaald in de tweede van de drie categoriën
                </p>
            </template>
            <template v-slot:message-high-threshold>
                <p>
                    Hier komt de toelichting voor wanneer iemand een score heeft behaald in de derde van de drie categoriën
                </p>
            </template>
        </CheckInterface>

        <CheckInterface
            store="testCheckQuestions"
            :lowThreshold="{ max: 10 }"
            :midThreshold="{ min: 11, max: 20 }"
            :highThreshold="{ min: 21 }"
            :checkId="2"
        >
            <template v-slot:message-low-threshold>
                <p>
                    Hier komt de toelichting voor wanneer iemand een score heeft behaald in de onderste van de drie categoriën
                </p>
            </template>
            <template v-slot:message-mid-threshold>
                <p>
                    Hier komt de toelichting voor wanneer iemand een score heeft behaald in de tweede van de drie categoriën
                </p>
            </template>
            <template v-slot:message-high-threshold>
                <p>
                    Hier komt de toelichting voor wanneer iemand een score heeft behaald in de derde van de drie categoriën
                </p>
            </template>
        </CheckInterface>

    </Layout>
</template>
