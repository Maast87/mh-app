<script setup>
    import Layout from "@/Pages/Shared/Layout.vue";
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import {Head, useForm} from '@inertiajs/vue3';
    import {provide} from "vue";

    const breadcrumbs = [
        { label: "home", href: "/" },
        { label: "log in", href: "/login" },
        { label: "wachtwoord vergeten" }
    ];
    provide('breadcrumbs', breadcrumbs);

    defineProps({
        status: {
            type: String,
        },
    });

    const form = useForm({
        email: '',
    });

    const submit = () => {
        form.post(route('password.email'));
    };
</script>

<template>
    <Layout>
        <Head title="Wachtwoord vergeten" />

        <div class="flex flex-col w-full items-center pb-10">
            <div class="flex flex-col justify-center items-center w-full px-10 pt-20 pb-10 gap-y-2">
                <h1 class="text-header_xl text-blue_700_gray_100 text-center">Wachtwoord <span class="gradient-text">vergeten</span></h1>
                <p class="text-base text-blue_700_gray_100 text-center">Oeps, dat gebeurt iedereen weleens. Vul hieronder je e-mailadres in,<br>dan sturen we je een mail waarmee je je wachtwoord kunt resetten.</p>
            </div>

            <div class="gradient-background rounded-2xl p-3 lg:w-1/2">
                <div class="flex flex-col bg-gray_100_blue_900 rounded-xl w-full gap-y-3 p-3 shadow-mh_box_shadow">

                    <div 
                        v-if="status"
                        class="flex items-center mb-4 text-sm font-medium border border-blue_700_gray_100 rounded-lg p-1.5 gap-x-1.5"
                    >
                        <div class="w-10 h-10">
                            <svg id="uuid-b8f6a5c4-e2ad-4025-8699-8e391ad2ceec" data-name="Content" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                                <circle cx="61.5" cy="62.5" r="45.5" style="fill: none; stroke: var(--mh-blue-700-gray-100); stroke-miterlimit: 10; stroke-width: 4.5px;"/>
                                <g>
                                    <line x1="56.62" y1="84.65" x2="40.98" y2="65.28" style="fill: none; stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px;"/>
                                    <line x1="86.57" y1="43.08" x2="56.62" y2="84.65" style="fill: none; stroke: var(--mh-blue-700-gray-100); stroke-linecap: round; stroke-linejoin: round; stroke-width: 4.5px;"/>
                                </g>
                            </svg>
                        </div>
                        <p class="text-blue_700_gray_100">
                            {{ status }}
                        </p>
                    </div>

                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="email" value="E-mailadres" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4 flex items-center justify-end">
                            <button
                                class="button-one w-full"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Verstuur wachtwoord reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Layout>
</template>
